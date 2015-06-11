<?php
/**
 * Created by PhpStorm.
 * User: develop1
 * Date: 04.06.15
 * Time: 12:12
 */

namespace Acme\TaskBundle\Security\Authorization\Voter;



use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Acme\TaskBundle\Entity\User;


class TaskVoter extends AbstractVoter
{
    const ROLE_VIEW = 'view';
    const ROLE_CREATE = 'create';
    const ROLE_EDIT = 'edit';
    const ROLE_ADMIN = 'admin';

    protected $tokenStorage;

    public function setTokenStorage(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }
    protected function getSupportedAttributes()
    {
        return array(self::ROLE_VIEW, self::ROLE_CREATE, self::ROLE_EDIT, self::ROLE_ADMIN);
    }

    protected function getSupportedClasses()
    {
        return array('Acme\TaskBundle\Entity\Task');
    }

    protected function isGranted($attribute, $post, $user = null)
    {
        // make sure there is a user object (i.e. that the user is logged in)
        if (!$user instanceof UserInterface) {
            return false;
        }

        // custom business logic to decide if the given user can view
        // and/or edit the given post
        if ($attribute == self::ROLE_VIEW ) {
            return true;
        }

        if ($attribute == self::ROLE_CREATE) {
            return true;
        }

        if ($attribute == self::ROLE_EDIT && $user->getId() === $post->getOwner()->getId()) {
            return true;
        }

        if ($attribute == self::ROLE_ADMIN)
            {
                return true;
            }

        return false;
    }
}