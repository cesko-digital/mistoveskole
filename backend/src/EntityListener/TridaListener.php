<?php
namespace App\EntityListener;

use Psr\Log\LoggerInterface;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\OnFlushEventArgs;
use App\Entity\Trida;
use App\Entity\TridaHistorieKapacity;
use App\Entity\Zarizeni;
use Symfony\Component\HttpFoundation\RequestStack;

class TridaListener
{
    /**
     * note: only onflush supports changing of other entities
     * @see https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/events.html#onflush
     */
    public function onFlush(OnFlushEventArgs $args)
    {
        $em = $args->getEntityManager();
        $uow = $em->getUnitOfWork();

        $entities = array_merge(
            $uow->getScheduledEntityInsertions(),
            $uow->getScheduledEntityUpdates()
        );

        foreach ($entities as $entity) {
            if (!$entity instanceof Trida) {
                continue;
            }

            // sum capacity into Zarizeni
            // TODO prevent call sumCapacity() for each trida again?
            $zarizeni = $entity->getIdZarizeni();
            $zarizeni->sumCapacity();
            $uow->persist($zarizeni);

            // store daily history
// FIXME works only for today, lookup $entity->getDatumCasAktualizace() in history first!
            $historie = $entity->getHistorieKapacity();
            if ($historie->count() == 0 || $historie->first()->getDatum() != (new \DateTime('midnight'))) {
                // new row for today
                $tridaHistorie = new TridaHistorieKapacity();
                $tridaHistorie->setKapacitaUkVolno($entity->getAktualniKapacitaUkVolno())
                    ->setKapacitaUkObsazeno($entity->getAktualniKapacitaUkObsazeno())
                    ->setDatum($entity->getDatumCasAktualizace())
                ;
                $entity->addHistorieKapacity($tridaHistorie);
                $uow->persist($tridaHistorie);
                $tridaHistorieMetadata = $em->getClassMetadata(get_class($tridaHistorie));
                $uow->computeChangeSet($tridaHistorieMetadata, $tridaHistorie);
            } else {
                // update for today
                $tridaHistorie = $historie->first(); // collection must be sorted 
                $tridaHistorie->setKapacitaUkVolno($entity->getAktualniKapacitaUkVolno())
                    ->setKapacitaUkObsazeno($entity->getAktualniKapacitaUkObsazeno())
                    ->setDatum($entity->getDatumCasAktualizace())
                ;
                $uow->persist($tridaHistorie);
                $tridaHistorieMetadata = $em->getClassMetadata(get_class($tridaHistorie));
                $uow->computeChangeSet($tridaHistorieMetadata, $tridaHistorie);
            }
            $uow->persist($zarizeni);
            $zarizeniMetadata = $em->getClassMetadata(get_class($zarizeni));
            $uow->computeChangeSet($zarizeniMetadata, $zarizeni);
        }
    }
}
