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
 */

class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

//    /**
//     * @ORM\Column(name="role",type="integer", options={"default":1})
//     * @ORM\ManyToOne(targetEntity="Role", inversedBy="user")
//     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
//     */
//    protected $role;

    public function  __construct()
    {
        parent::__construct();
        $this->addRole('ROLE_VIEW');
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
}
