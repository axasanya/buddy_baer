<?php

namespace BuddyBaer\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BuddyBaerFrontendBundle:Default:index.html.twig');
    }
}
