<?php

namespace BuddyBaer\Bundle\ManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        /** @var Ivory\GoogleMapBundle\Model\Map */
        $map = $this->get('ivory_google_map.map');
       // var_dump("<pre>", $map);die;

        return $this->render('BuddyBaerManagerBundle:Default:index.html.twig', array('map' => $map));
    }
}
