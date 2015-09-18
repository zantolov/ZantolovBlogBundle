<?php

namespace Zantolov\BlogBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Zantolov\AppBundle\Entity\Interfaces\SluggableInterface;

class EntityEventListener
{
    public function postUpdate(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        $em = $eventArgs->getEntityManager();

//        $em->flush();

    }

    public function postPersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        $em = $eventArgs->getEntityManager();

//        $em->flush();
    }

}