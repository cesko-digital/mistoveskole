<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Service\RedIzoService;
use App\Entity;

#[AsCommand(
    name: 'app:load-redizo',
    description: 'loads redizo data from local json file',
)]
class LoadRedizoCommand extends Command
{
    /** @var EntityManagerInterface */
    protected $em;

    protected $io;

    /** {@inheritdoc} */
    public function __construct(RedIzoService $redIzo, ManagerRegistry $managerRegistry)
    {
        parent::__construct();
        $this->redIzoService = $redIzo;
        $this->em = $managerRegistry->getManager('default');
    }


    protected function configure(): void
    {
         $this
            ->addOption('only-contacts', null, InputOption::VALUE_NONE ,'update only zarizeni\'s contacts data', null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $this->io = $io;

        //$io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        if ($input->hasOption('only-contacts')) {
            $io->info('updating only contact data');
        }

        $list = $this->redIzoService->getRedIzoList();
        $counterNew = $counterUpdated = 0; 
        foreach ($list as $redIzo) {
            $detail = $this->redIzoService->getRedIzoDetail($redIzo);
            $entity = $this->em->getRepository(Entity\Reditelstvi::class)->findOneBy(array('redIzo' => $redIzo));
            if ($entity) {
                $this->formatReditelstvi($entity, $detail, $input->hasOption('only-contacts'));
                $this->em->persist($entity);
                $this->em->flush();
                $io->info('updated existing '.$redIzo);
                $counterUpdated++;
//                if ($counterUpdated> 2000) break;
            } else {
                if ($input->hasOption('only-contacts')) {
                    $io->info('skipping '.$detail['name'].', only contacts update');
                    continue;
                }
                $entity = new Entity\Reditelstvi();
                $this->formatReditelstvi($entity, $detail, false);
                $this->em->persist($entity);
                $this->em->flush();
                $io->success('created: '.$detail['name']);
                $counterNew++;
//                if ($counterNew > 100) break;
            }
        }
        $io->success('new: '.$counterNew.', updated: '.$counterUpdated);
        return Command::SUCCESS;
    }

    protected function loadSupportedTypes(): array
    {
        $result = array();
        $list = $this->em->getRepository(Entity\TypZarizeni::class)->findBy(array('aktivni' => true));
        foreach ($list as $value) {
            if ($value->getIdMsmt()) {
                $result[$value->getIdMsmt()] = $value;
            }
        }

        return $result;
    }

    protected function formatReditelstvi(Entity\Reditelstvi $entity, array $detail, bool $contactOnly):void
    {
        $okresRepository = $this->em->getRepository(Entity\Okres::class);
        $zarizeniRepository = $this->em->getRepository(Entity\Zarizeni::class);
        $types = $this->loadSupportedTypes();

        if (!$contactOnly) {
            $entity->setRedIzo($detail['redIzo'])
                ->setRedPlnyNazev($detail['name'])
                ->setRedRuianKod($detail['address']['ruainCode'] ?? null)
                ->setIdOrp(str_replace('CZ0', '', $detail['orp']))
                ->setIdOkres($okresRepository->findOneBy(array('idNuts2' => $detail['okres'])))
                ->setRedAdresa1($detail['address']['line1'])
                ->setRedAdresa2($detail['address']['line2'])
                ->setRedAdresa3($detail['address']['line3'])
            ;
        }
        foreach ($detail['schools'] as $subDetail) {
            if (!array_key_exists($subDetail['type'], $types)) { // only whitelisted types
                $this->io->info("skiping ".$subDetail['type']." ".$subDetail['name']."\n");
                continue;
            }
            $zarizeni = $zarizeniRepository->findOneBy(array('izo' => $subDetail['izo']));
            if (!$zarizeni) {
                $zarizeni = new Entity\Zarizeni();
            }
            $contacts = $detail['contacts'] ?? [];
            $this->formatZarizeni($zarizeni, $subDetail, $types, $contacts, $contactOnly);
            if (!empty($zarizeni->getSkolaPlnyNazev())) {
                $entity->addZarizeni($zarizeni);
                $this->em->persist($zarizeni);
            }
        }
    }

    protected function formatZarizeni(Entity\Zarizeni $izo, array $data, array &$types, array &$contacts, $contactOnly): void
    {
        $jazykRepository = $this->em->getRepository(Entity\JazykVyuky::class);
        $jazyk = $jazykRepository->findOneBy(array('jmenoCz' => $data['language'])); // note: matching by full string
        if (!$jazyk) {
            $this->io->warning("skipping ".$data['name'].", izo ".$data['izo'].", missing language ".$data['language']);
            return;
        }
        if (!$contactOnly) {
            $izo->setIzo($data['izo'])
                ->setSkolaPlnyNazev($data['name'])
                ->setSkolaKapacita($data['capacity'])
                ->setAktivni(true)
                ->setIdJazyk($jazyk)
                ->setIdSkolaTyp($types[$data['type']])
                ->setMistoAdresa1($data['address']['line1'])
                ->setMistoRuianKod($data['address']['ruainCode'] ?? null)
            ;
            if (empty($data['address']['line3'])) { // FIXME - does not work?
                // two line address
                $izo->setMistoAdresa3($data['address']['line2']);
            } else {
                $izo
                    ->setMistoAdresa2($data['address']['line2'])
                    ->setMistoAdresa3($data['address']['line3'])
                ;
            }
        }
        if (count($contacts)>0) {
            if (isset($contacts['emails'])) {
                $value = count($contacts['emails']) > 0 ? implode(',', $contacts['emails']) : null;
                $izo->setKontaktEmail($value);
            }
            if (isset($contacts['phone'])) {
                $value = count($contacts['phone']) > 0 ? implode(',', $contacts['phone']) : null;
                $izo->setKontaktTelefon($value);
            }
            if (isset($contacts['web'])) {
                // keep http:// if present
                foreach ($contacts['web'] as &$web) {
                    if (!preg_match('#https?://#i', $web)) {
// TODO fix http if wrong typed
                        $web = 'https://'.$web;
                    }
                    $web = strtolower(trim($web));
                }
                $value = count($contacts['web']) > 0 ? implode(',', $contacts['web']) : null;
                $izo->setKontaktWww($value);
            }
        }
    }
}
