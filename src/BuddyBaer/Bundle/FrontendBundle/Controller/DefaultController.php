<?php

namespace BuddyBaer\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BuddyBaer\Bundle\ManagerBundle\Entity\BuddyBaer as BuddyBaer;
use BuddyBaer\Bundle\ManagerBundle\Helper\BaerHelper;


class DefaultController extends Controller
{
    public function indexAction()
    {
        $baerRepository = $this->getDoctrine()
            ->getRepository('BuddyBaerManagerBundle:BuddyBaer');
        $allBears = $baerRepository->findAll();

        $markers = array();
        foreach($allBears as $baer){
            $markers[] = BaerHelper::getMarker($baer);
        }

        return $this->render('BuddyBaerFrontendBundle:Default:index.html.twig', array('markers' => $markers));
    }
}
