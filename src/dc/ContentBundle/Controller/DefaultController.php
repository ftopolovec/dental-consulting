<?php

namespace dc\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('dcContentBundle:Default:index.html.twig');
    }
}
