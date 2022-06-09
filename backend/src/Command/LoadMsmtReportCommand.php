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
use Doctrine\Common\Collections\Criteria;
use App\Service\RedIzoService;
use App\Entity;

#[AsCommand(
    name: 'app:load-msmt',
    description: 'loads msmt report data from local json file. convert xls to json ie. with in2csv | csvjson',
)]
class LoadMsmtReportCommand extends Command
{
    const NAME = 'app:load-msmt';

    /** @var EntityManagerInterface */
    protected $em;

    protected $io;

    /** @var Entity\Zrizovatel[] */
    protected $zrizovatel = array();

    /** @var Entity\TypZarizeni[] */
    protected $typZarizeni = array();

    /** @var Entity\TridaVlastnosti[] */
    protected $vlastnosti = array();

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
            ->addOption('file', null, InputOption::VALUE_REQUIRED ,'path to report in json format', null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $this->io = $io;

        if (!($file = $input->getOption('file'))) {
            $this->io->error(static::NAME.': required parameter "file" is missing');
            return Command::FAILURE;
        }

        if (!is_file($file)) {
            $this->io->error(static::NAME.': file '.$file. ' not found');
            return Command::FAILURE;

        }

        $data = file_get_contents($file);
        $json = json_decode($data, true);

        if (!is_array($json) || count($json) == 0) {
            $this->io->error(static::NAME.': json in file '.$file. ' missing or not well formatted');
            return Command::FAILURE;

        }
        $io->success(static::NAME.': loaded '.count($json).' lines from json');

        $this->zrizovatel = $this->loadZrizovatel();
        $this->typZarizeni = $this->loadTypZarizeni();

        $counter = 0;
        foreach ($json as $row) {
            $typ = '';
            if ($row['MŠ'] == true) {
                $entity = $this->formatZarizeni($row, 'A00');
                if ($entity) {
                    $counter++;
                    $typ .= 'MŠ';
                } else {
                    $entity = $this->formatZarizeni($row, 'A15');
                    if ($entity) {
                        $counter++;
                        $typ .= 'LMŠ';
                    }
                }
            }
            if ($row['ZŠ'] == true) {
//continue;
                $entity = $this->formatZarizeni($row, 'B00');
                if ($entity) {
                    $counter++;
                    $typ .= ' ZŠ';
                }
            }
            if ($entity) {
                $this->io->info(static::NAME.': updated '.$row['NÁZEV ZKRÁCENĚ']. ', '.$typ.', id:'.$entity->getId());
            }
//if ($counter > 1000) break;
        }
        return Command::SUCCESS;

        $io->success(static::NAME.': updated count '.$counter);
        return Command::SUCCESS;
    }

    protected function loadZrizovatel(): array
    {
        $result = array();
        $list = $this->em->getRepository(Entity\Zrizovatel::class)->findAll();
        foreach ($list as $value) {
            $result[$value->getId()] = $value;
        }

        return $result;
    }

    protected function loadVlastnosti(): array
    {
        $result = array();
        $list = $this->em->getRepository(Entity\TridaVlastnosti::class)->findAll();
        foreach ($list as $value) {
            $result[$value->getId()] = $value;
        }

        return $result;
    }


    protected function loadTypZarizeni(): array
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

    protected function formatZarizeni(array $data, string $typZarizeni): ?Entity\Zarizeni
    {
        if (isset($data['ODESLÁNO']) && ($dateTime = new \DateTime($data['ODESLÁNO'])) && $data['ODESLÁNO'] < '2022-04-07') {
            $this->io->info(static::NAME.': SKIPPING update of '.$data['NÁZEV ZKRÁCENĚ'].', before 2022-04-07');
            return null;
        }

        $reditelstviRepository = $this->em->getRepository(Entity\Reditelstvi::class);

        $reditelstvi = $reditelstviRepository->findOneBy(array('redIzo' => $data["RED IZO"]));
        if (!$reditelstvi) {
            $this->io->error(static::NAME.': redizo '.$data["RED IZO"].' not found!');
            return null;
        }

        // select only first(!) matching type - no more detail in data
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('idSkolaTyp', $this->typZarizeni[$typZarizeni]))
            ->setMaxResults(1);
        $zarizeni = $reditelstvi->getZarizeni()->matching($criteria)->first();

        if (!$zarizeni) {
            $this->io->error(static::NAME.': redizo '.$data["RED IZO"].' with type: '.$typZarizeni .' not found!');
            return null;

        }
        // create classrooms by type and assign numbers
        if ($typZarizeni == 'A00' || $typZarizeni == 'A15') {
// datum jako vstupni hodnota
            $zarizeni->setKapacitaUk2223($data['MŠ OTÁZKA 3']);

            $trida = $this->formatTrida(
                $zarizeni,
                array(30,40,50),
                $data['MŠ OTÁZKA 2'],
                $data['MŠ OTÁZKA 1 (celkem)'] - $data['MŠ OTÁZKA 1 (povinné předškolní vzdělávání)'], // minus next "class" to have correct sum
                $dateTime
            );
            $this->em->persist($trida);

            // special class to store sum of used capacity
            $trida = $this->formatTrida(
                $zarizeni,
                array(2000),
                null,
                $data['MŠ OTÁZKA 1 (povinné předškolní vzdělávání)'],
                $dateTime
            );
            $this->em->persist($trida);

        } else { // B00
            $zarizeni->setKapacitaUk2223($data['ZŠ OTÁZKA 3']);

            foreach ($this->typZarizeni[$typZarizeni]->getTridyVlastnosti() as $vlastnost) {
                if (in_array($vlastnost, array(60,70,80,90,100,110,120,130,140))) { // 1.-9. rocnik
                    $rocnik = ($vlastnost / 10) - 5; // hardcoded
                    $trida = $this->formatTrida(
                        $zarizeni,
                        array($vlastnost),
                        $data['ZŠ OTÁZKA 2 ('.$rocnik.'. ročník)'],
                        null,
                        $dateTime
                    );
                    $this->em->persist($trida);
                }

                if ($data['ZŠ OTÁZKA 2 (malotřídky)'] > 0) {
                    $trida = $this->formatTrida(
                        $zarizeni,
                        array(60,70,80,90,100,1000),
                        $data['ZŠ OTÁZKA 2 (malotřídky)'],
                        null,
                        $dateTime
                    );
                    $this->em->persist($trida);
                }

                if ($data['ZŠ OTÁZKA 2 (speciální třídy 1. stupeň)'] > 0) {
                    $trida = $this->formatTrida(
                        $zarizeni,
                        array(60,70,80,90,100,1100),
                        $data['ZŠ OTÁZKA 2 (speciální třídy 1. stupeň)'],
                        null,
                        $dateTime
                    );
                    $this->em->persist($trida);
                }
                if ($data['ZŠ OTÁZKA 2 (speciální třídy 2. stupeň)'] > 0) {
                    $trida = $this->formatTrida(
                        $zarizeni,
                        array(110,120,130,140,1105),
                        $data['ZŠ OTÁZKA 2 (speciální třídy 2. stupeň)'],
                        null,
                        $dateTime
                    );
                    $this->em->persist($trida);
                }
                // special class to store sum of used capacity
                $trida = $this->formatTrida(
                    $zarizeni,
                    array(2010),
                    null,
                    $data['ZŠ OTÁZKA 1'],
                    $dateTime
                );
                $this->em->persist($trida);
            }
        }

        // update other data (if differ - checked by doctrine)
        $zarizeni->getIdReditelstvi()
            ->setIdZrizovatel($this->zrizovatel[$data['ZŘIZOVATEL']])
            ->setDatovaSchranka($data['DATOVKA'])
            ->setObec($data['OBEC'])
            ->setRedZkracenyNazev($data['NÁZEV ZKRÁCENĚ'])
            ->setAktivni(true)
        ;
        $this->em->persist($zarizeni);
        $this->em->flush();

        return $zarizeni;
    }

    protected function formatTrida(Entity\Zarizeni $zarizeni, array $vlastnosti, $kapacitaVolno, $kapacitaObsazeno, \DateTime $datumCas)
    {
        $tridy = $zarizeni->getTridy();
        $trida = null;
        foreach ($tridy as $t) {
            // find matching class
            $tridaVlastnosti = $t->getVlastnosti();
            if (is_array($tridaVlastnosti) && count(array_intersect($vlastnosti, $tridaVlastnosti)) == count($vlastnosti)) {
                $trida = $t;
                break;
            }
        }
        if (empty($trida)) {
            $trida = new Entity\Trida();
            $trida->setVlastnosti($vlastnosti);
            $zarizeni->addTridy($trida);
        }
        $trida->setAktualniKapacitaUkVolno($kapacitaVolno)
            ->setAktualniKapacitaUkObsazeno($kapacitaObsazeno)
            ->setDatumCasAktualizace($datumCas)
        ;
        return $trida;
    }
}
