<?php

namespace MandarinMedien\MMCmfMenuBundle\Entity;

use MandarinMedien\MMCmfNodeBundle\Entity\NodeRoute;
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
     * @var NodeRoute|null
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
     * @return NodeRoute|null
     */
    public function getNodeRoute()
    {
        return $this->nodeRoute;
    }

    /**
     * @param NodeRoute|null $nodeRoute
     * @return MenuItem
     */
    public function setNodeRoute(NodeRoute $nodeRoute = null)
    {
        $this->nodeRoute = $nodeRoute;
        return $this;
    }
}

