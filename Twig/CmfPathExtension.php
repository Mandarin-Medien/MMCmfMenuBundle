<?php

namespace MandarinMedien\MMCmfMenuBundle\Twig;

use MandarinMedien\MMCmfNodeBundle\Entity\ExternalNodeRoute;
use MandarinMedien\MMCmfNodeBundle\Entity\NodeRoute;
use Symfony\Component\DependencyInjection\Container;

class CmfPathExtension extends \Twig_Extension
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
            new \Twig_SimpleFunction('cmfPath', array($this, "cmfPathFunction"), array(
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
    public function cmfPathFunction(NodeRoute $nodeRoute = null, array $options=array())
    {
        if($nodeRoute) {
            if ($nodeRoute instanceof ExternalNodeRoute) {
                $path = $nodeRoute->getRoute();
            } else {
                $path = preg_replace("#(/{2,})#", '/', $this->container->get('router')->generate('mm_cmf_node', array(
                    'route' => $nodeRoute->getRoute()
                )));
            }
        }

        return $path ?: '';
    }



    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'mm_cmf_path_extension';
    }

}