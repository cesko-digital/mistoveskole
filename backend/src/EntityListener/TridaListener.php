<?php
namespace App\EntityListener;

use Psr\Log\LoggerInterface;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\OnFlushEventArgs;
use App\Entity\Trida;
use App\Entity\Zarizeni;
use Symfony\Component\HttpFoundation\RequestStack;

class TridaListener
{
    /**
     * note: only onflush supports changing of other entities
     * @see https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/events.html#onflush.
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

            // TODO prevent call sumCapacity() for each trida again?
            $zarizeniMetadata = $em->getClassMetadata(Zarizeni::class);
            $zarizeni = $entity->getIdZarizeni();
            $zarizeni->sumCapacity();
            $em->persist($zarizeni);
            $uow->recomputeSingleEntityChangeSet($zarizeniMetadata, $zarizeni);
            }

            // TODO store into tridahistorie too
        }

}
