<?php

namespace MandarinMedien\MMCmfMenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MMCmfMenuBundle:Default:index.html.twig', array('name' => $name));
    }
}
