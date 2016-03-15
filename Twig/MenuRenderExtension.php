<?php

namespace MandarinMedien\MMCmfMenuBundle\Twig;

use MandarinMedien\MMCmfMenuBundle\Entity\Menu;
use MandarinMedien\MMCmfMenuBundle\Entity\MenuItem;
use Symfony\Component\DependencyInjection\Container;

class MenuRenderExtension extends \Twig_Extension
{

    private $container;
    private $templates;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }


    /**
     * register menu template
     *
     * @param $name
     * @param $template
     */
    public function registerTemplate($name, $template)
    {
        $this->templates[$name] = $template;
    }


    /**
     * get menu template by name
     * @param $name
     * @return mixed
     * @throws \Twig_Error_Runtime
     */
    public function getTemplate($name)
    {
        if ($this->templates[$name]) {
            return $this->templates[$name];
        } else {
            throw new \Twig_Error_Runtime(sprintf('Template %s not found', $name));
        }
    }


    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('renderMenuByName', array($this, "renderMenuByNameFunction"), array(
                'is_safe' => array('html'),
                'needs_environment' => true
            )),
            new \Twig_SimpleFunction('renderMenu', array($this, "renderMenuFunction"), array(
                'is_safe' => array('html'),
                'needs_environment' => true
            )),
            new \Twig_SimpleFunction('renderMenuItem', array($this, "renderMenuItemFunction"), array(
                'is_safe' => array('html'),
                'needs_environment' => true
            ))
        );
    }

    /**
     * renders the menu
     *
     * @deprecated deprecated since 0.0.2
     *
     * @param \Twig_Environment $twig
     * @param Menu $menu
     * @param array $options
     * @return string
     */
    public function renderMenuFunction(\Twig_Environment $twig, Menu $menu, array $options = array())
    {
        return $twig->render('MMCmfMenuBundle:Default:menu.html.twig', array('menu' => $menu, 'options' => $options));
    }


    /**
     * renders an menuitem
     *
     * @deprecated deprecated since 0.0.2
     *
     * @param \Twig_Environment $twig
     * @param MenuItem $item
     * @param array $options
     * @return string

     */
    public function renderMenuItemFunction(\Twig_Environment $twig, MenuItem $item, array $options = array())
    {
        if ($item->getNodeRoute())
            return $twig->render("@MMCmfMenu/Default/menuItem.html.twig", array('item' => $item, 'options' => $options));

        return null;
    }


    /**
     * get the them menu by name and render it
     *
     * @param \Twig_Environment $twig
     * @param $name
     * @param array $options
     * @param string $template
     * @return null|string
     */
    public function renderMenuByNameFunction(\Twig_Environment $twig, $name, array $options = array(), $template = 'default')
    {

        // find the menu by name
        if ($name) {
            $repository = $this->container->get("doctrine.orm.entity_manager")->getRepository('MMCmfMenuBundle:Menu');

            $menu = $repository->findOneBy(array('name' => $name));

            if ($menu) {

                try {
                    return $twig->render(
                        $this->getTemplate($template),
                        array(
                            'menu' => $menu,
                            'options' => array()
                        )
                    );
                } catch (\Exception $e) {
                    return $this->renderMenuFunction($twig, $menu, $options);
                }

            }

            return null;
        }
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'mm_cmf_menu_extension';
    }

}