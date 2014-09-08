<?php

namespace Sick\Bundle\ListsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Project
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Project
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
	 * @ORM\Column(type="string")
	 */
	protected $text;

	/**
	 *@ORM\OneToMany(targetEntity="ListItem", mappedBy="project")
	 */
	protected $items;

	public function __construct()
	{
		$this->items = new ArrayCollection();
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
     * Add items
     *
     * @param \Sick\Bundle\ListsBundle\Entity\ListItem $items
     * @return Project
     */
    public function addItem(\Sick\Bundle\ListsBundle\Entity\ListItem $items)
    {
        $this->items[] = $items;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \Sick\Bundle\ListsBundle\Entity\ListItem $items
     */
    public function removeItem(\Sick\Bundle\ListsBundle\Entity\ListItem $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Project
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
}
