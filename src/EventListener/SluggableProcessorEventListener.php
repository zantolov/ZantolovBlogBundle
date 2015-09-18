<?php

namespace Zantolov\BlogBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Zantolov\AppBundle\Entity\Interfaces\SluggableInterface;

class SluggableProcessorEventListener
{

    private $needsFlush = false;

    public function processSlug(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();

        if ($entity instanceof SluggableInterface) {
            $existingSlug = $entity->getSlug();
            if (empty($existingSlug)) {
                $entity->setSlug($entity->generateSlug());
            }
            $this->needsFlush = true;
        }

    }


    public function postPersist(LifecycleEventArgs $eventArgs)
    {
        $this->processSlug($eventArgs);
    }


    public function postUpdate(LifecycleEventArgs $eventArgs)
    {
        $this->processSlug($eventArgs);
    }

    public function postFlush(PostFlushEventArgs $eventArgs)
    {
        if ($this->needsFlush) {
            $this->needsFlush = false;
            $eventArgs->getEntityManager()->flush();
        }
    }

}