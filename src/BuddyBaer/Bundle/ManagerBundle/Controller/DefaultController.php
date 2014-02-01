<?php

namespace BuddyBaer\Bundle\ManagerBundle\Controller;

use BuddyBaer\Bundle\ManagerBundle\Helper\BaerHelper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BuddyBaer\Bundle\ManagerBundle\Entity\BuddyBaer as BuddyBaer;
use Symfony\Component\HttpFoundation\Request;
use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMapBundle\Entity\Map as Map;



class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        /** @var Map */
        $map = $this->get('ivory_google_map.map');

        $baerRepository = $this->getDoctrine()
            ->getRepository('BuddyBaerManagerBundle:BuddyBaer');
        $allBears = $baerRepository->findAll();

        foreach($allBears as $baer){
            $map->addMarker( BaerHelper::getMarker($baer));
        }

        $newBuddyBaer = new BuddyBaer();
        $form = $this->createBaerForm($newBuddyBaer);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            /**
             * @var FileHelper
             */
            $fileHelper = $this->get('buddy_baer.file_helper');
            $newBuddyBaer->setFileHelper($fileHelper);
            $newBuddyBaer->upload();

            $em->persist($newBuddyBaer);
            $em->flush();

            return $this->redirect($this->generateUrl('buddy_baer_manager_homepage'));
        }

        return $this->render('BuddyBaerManagerBundle:Default:index.html.twig',
            array('map' => $map,
                'form'=> $form->createView()
        ));
    }


    /**
     * @param BuddyBaer $buddyBaer
     */
    private function createBaerForm(BuddyBaer $buddyBaer){
        $form = $this->createFormBuilder($buddyBaer)
            ->add('name', 'text', array("required" => false))
            ->add('description', 'textarea', array("required" => false))
            ->add('latitude', 'text', array("required" => false))
            ->add('longitude', 'text', array("required" => false))
            ->add('file' )
            ->add('save', 'submit')
            ->getForm();
        return $form;
    }
}
