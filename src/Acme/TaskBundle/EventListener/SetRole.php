<?php
/**
 * Created by PhpStorm.
 * User: develop1
 * Date: 08.06.15
 * Time: 15:55
 */

namespace Acme\TaskBundle\EventListener;

use Acme\TaskBundle\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Acme\TaskBundle\Entity\Task;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class SetRole
{
    protected $tokenStorage;

    public function setTokenStorage(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
//        $entityManager = $args->getEntityManager();
        if($entity instanceof User)
        {
            $em = $args->getEntityManager()->getRepository("AcmeTaskBundle:Role");
            $entity->setRole('1');
        }

        if($entity instanceof Task)
        {
            $entity->setOwner($this->tokenStorage->getToken()->getUser());
        }

    }
}