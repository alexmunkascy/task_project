<?php

namespace Acme\TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Task
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Task
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
     * @ORM\Column(name="task", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $task;

    /**
     * @ORM\Column(name="dueDate", type="date")
     * @Assert\NotBlank()
     * @Assert\Type("DateTime")
     */
    private $dueDate;

    /**
     * @ORM\Column(name="dueTime", type="time")
     * @Assert\NotBlank()
     * @Assert\Time()
     */
    private $dueTime;

    /**
     * @Assert\Type(type="Acme\TaskBundle\Entity\Category")
     * @Assert\Valid()
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="task")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory(Category $category = null)
    {
        $this->category = $category;
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
     * Set dueDate
     *
     * @param \date" $dueDate
     * @return Task
     */
    public function setDueDate(\dateTime $dueDate = null)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \date" 
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set task
     *
     * @param string $task
     * @return Task
     */
    public function setTask($task)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task
     *
     * @return string 
     */
    public function getTask()
    {
        return $this->task;
    }



    /**
     * Set dueTime
     *
     * @param \DateTime $dueTime
     * @return Task
     */
    public function setDueTime($dueTime)
    {
        $this->dueTime = $dueTime;

        return $this;
    }

    /**
     * Get dueTime
     *
     * @return \DateTime 
     */
    public function getDueTime()
    {
        return $this->dueTime;
    }
}