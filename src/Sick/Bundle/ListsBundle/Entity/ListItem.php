<?php

namespace Sick\Bundle\ListsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="items")
 */
class ListItem
{
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $text;

	/**
	 * @ORM\ManyToOne(targetEntity="Project", inversedBy="items")
	 * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
	 */
	protected $project;

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
     * Set text
     *
     * @param string $text
     * @return ListItem
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set project
     *
     * @param \Sick\Bundle\ListsBundle\Entity\Project $project
     * @return ListItem
     */
    public function setProject(\Sick\Bundle\ListsBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Sick\Bundle\ListsBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
    }
}
