<?php
/**
 * Created by PhpStorm.
 * User: develop1
 * Date: 08.06.15
 * Time: 15:55
 */

namespace Acme\TaskBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Acme\TaskBundle\Entity\Task;


class SetRole
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();
        if($entity instanceof Task)
        {
            $em = $args->getEntityManager()->getRepository("AcmeTaskBundle:Role");
            $entity->setRole($em->find('1'));
        }
    }
}