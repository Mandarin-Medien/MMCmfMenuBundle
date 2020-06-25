<?php

namespace MandarinMedien\MMCmfMenuBundle\Twig;

use MandarinMedien\MMCmfNodeBundle\Entity\AutoNodeRoute;
use MandarinMedien\MMCmfNodeBundle\Entity\ExternalNodeRoute;
use MandarinMedien\MMCmfNodeBundle\Entity\NodeRoute;
use MandarinMedien\MMCmfNodeBundle\Entity\RoutableNodeInterface;
use Symfony\Component\DependencyInjection\Container;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CmfPathExtension extends AbstractExtension
{

    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }


    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new TwigFunction('cmfPath', array($this, "cmfPathFunction"), array(
                'is_safe' => array('html'),
            )),
            new TwigFunction('nodePath', array($this, "nodePathFunction"), array(
                'is_safe' => array('html'),
            ))
        );
    }


    /**
     * build url by given node route
     * @param NodeRoute $nodeRoute
     * @param array $options
     * @return string
     */
    public function cmfPathFunction(NodeRoute $nodeRoute = null, array $options = array())
    {

        $path = '';

        if ($nodeRoute) {
            if ($nodeRoute instanceof ExternalNodeRoute) {
                $path = $nodeRoute->getRoute();
            } else {
                $path = preg_replace("#(/{2,})#", '/', $this->container->get('router')->generate('mm_cmf_node', array(
                    'route' => $nodeRoute->getRoute()
                )));
            }
        }

        return $path;
    }

    /**
     * build url by given node
     * @param NodeRoute $nodeRoute
     * @param array $options
     * @return string
     */
    public function nodePathFunction(RoutableNodeInterface $node = null, array $options = array())
    {
        $path = '';
        $nodeRoute = null;
        foreach ($node->getRoutes() as $feNodeRoute) {
            if ($feNodeRoute instanceof AutoNodeRoute) {
                $nodeRoute = $feNodeRoute;
                continue;
            }
        }

        if (!$nodeRoute)
            $nodeRoute = count($node->getRoutes()) > 0 ? $node->getRoutes()[0] : null;

        if ($nodeRoute) {
            if ($nodeRoute instanceof ExternalNodeRoute) {
                $path = $nodeRoute->getRoute();
            } else {
                $path = preg_replace("#(/{2,})#", '/', $this->container->get('router')->generate('mm_cmf_node', array(
                    'route' => $nodeRoute->getRoute()
                )));
            }
        }

        return $path;
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'mm_cmf_path_extension';
    }

}