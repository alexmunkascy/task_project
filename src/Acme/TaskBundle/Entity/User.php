<?php
/**
 * Created by PhpStorm.
 * User: develop1
 * Date: 05.06.15
 * Time: 10:19
 */

namespace Acme\TaskBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package Acme\TaskBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\HasLifecycleCallbacks()
 */

class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="role",type="integer")
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="user")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     */
    protected $role;

    /**
     * @var string
     * @ORM\OneToMany(targetEntity="Acme\TaskBundle\Entity\Task", mappedBy="owner")
     */
    protected $task;

    public function  __construct()
    {
        parent::__construct();
        $this->addRole('ROLE_VIEW');
        $this->addRole('ROLE_EDIT');
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set role
     *
     * @param integer $role
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return integer 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add task
     *
     * @param \Acme\TaskBundle\Entity\Task $task
     * @return User
     */
    public function addTask(\Acme\TaskBundle\Entity\Task $task)
    {
        $this->task[] = $task;

        return $this;
    }

    /**
     * Remove task
     *
     * @param \Acme\TaskBundle\Entity\Task $task
     */
    public function removeTask(\Acme\TaskBundle\Entity\Task $task)
    {
        $this->task->removeElement($task);
    }

    /**
     * Get task
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTask()
    {
        return $this->task;
    }
}
