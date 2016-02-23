<?php

namespace MandarinMedien\MMCmfMenuBundle\Entity;

use MandarinMedien\MMCmfRoutingBundle\Entity\NodeRoute;
/**
 * MenuItem
 */
class MenuItem extends Menu
{

    /**
     * @var string
     */
    private $title;


    /**
     * @var NodeRoute
     */
    private $nodeRoute;


    /**
     * Set title
     *
     * @param string $title
     *
     * @return MenuItem
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * @return NodeRoute
     */
    public function getNodeRoute()
    {
        return $this->nodeRoute;
    }

    /**
     * @param NodeRoute $node
     * @return MenuItem
     */
    public function setNodeRoute(NodeRoute $nodeRoute)
    {
        $this->nodeRoute = $nodeRoute;
        return $this;
    }
}

