<?php

namespace BuddyBaer\Bundle\ManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BuddyBaerManagerBundle:Default:index.html.twig');
    }
}
