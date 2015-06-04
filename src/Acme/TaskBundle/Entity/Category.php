<?php

namespace Acme\TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $name;
    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="category")
     */
    protected $task;


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
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Category
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function __toString() {
        return $this->getName();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->task = new ArrayCollection();
    }

    /**
     * Add task
     *
     * @param \Acme\TaskBundle\Entity\Task $task
     * @return Category
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
