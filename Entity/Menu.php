<?php

namespace MandarinMedien\MMCmfMenuBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Menu
 */
class Menu
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var ArrayCollection
     */
    protected $items;

    /**
     * @var Menu
     */
    protected $parent;


    /**
     * @var integer
     */
    protected $position = 0;


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
     * Set name
     *
     * @param string $name
     *
     * @return Menu
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
     * Set items
     *
     * @param ArrayCollection $items
     *
     * @return Menu
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Get items
     *
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }


    /**
     * @param MenuItem $item
     * @return Menu
     */
    public function addItem(MenuItem $item)
    {
        $this->items->add($item);
        $item->setParent($this);
        return $this;
    }


    /**
     * @param MenuItem $item
     * @return  Menu
     */
    public function removeItem(MenuItem $item)
    {
        $this->items->removeElement($item);
        $item->setParent(null);
        return $this;
    }

    /**
     * @return Menu
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Menu $parent
     * @return Menu
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }


    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return MenuItem
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }


    public function __toString()
    {
        return $this->getName();
    }
}

