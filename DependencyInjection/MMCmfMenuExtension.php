<?php

namespace MandarinMedien\MMCmfMenuBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class MMCmfMenuExtension extends Extension

{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $this->registerTemplates($container, $config);
    }


    /**
     * register menu templates from config
     *
     * @param ContainerBuilder $container
     * @param $config
     */
    protected function registerTemplates(ContainerBuilder $container, $config)
    {
        if(!empty($config["templates"])) {

            foreach($config['templates'] as $template)
            $container->getDefinition('mm_cmf_menu.twig_menu_extension')
                ->addMethodCall('registerTemplate', array($template['name'], $template['template']));
        }
    }
}
