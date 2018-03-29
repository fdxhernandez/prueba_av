<?php

namespace AviaturBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AviaturBundle:Default:index.html.twig');
    }
}
