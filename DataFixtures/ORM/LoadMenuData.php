<?php

namespace MandarinMedien\MMCmfContentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MandarinMedien\MMCmfMenuBundle\Entity\Menu;
use MandarinMedien\MMCmfMenuBundle\Entity\MenuItem;
use MandarinMedien\MMCmfNodeBundle\Entity\NodeRoute;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadMenuData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $menu = new Menu();
        $menu->setName('Main');
        $menu->setPosition(0);

        $repoNodeRoute = $manager->getRepository(NodeRoute::class);

        /**
         * @var $nodeRoutes NodeRoute[]|array
         */
        $nodeRoutes = $repoNodeRoute->findAll();

        $menuItemPos = 1;
        foreach( $nodeRoutes as $route)
        {
            $menuItem = new MenuItem();
            $menuItem->setName($route->getNode()->getName());
            $menuItem->setNodeRoute($route);
            $menuItem->setPosition($menuItemPos);
            $menuItemPos++;

            $menu->addItem($menuItem);
            $manager->persist($menuItem);
        }

        $manager->persist($menu);

        $manager->flush();
    }

    public function getOrder()
    {
        return 4; // the order in which fixtures will be loaded
    }
}
