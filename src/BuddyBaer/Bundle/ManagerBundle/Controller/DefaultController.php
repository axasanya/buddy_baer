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




    //    $markerFromConfig = $this->get('ivory_google_map.marker');
    //    $map->addMarker($markerFromConfig);


      /*  $marker = new Marker();

        $marker->setPrefixJavascriptVariable('marker_');
        $marker->setPosition( 52.5343700,13.4305300, true);
        $marker->setAnimation(Animation::DROP);

        $marker->setOption('clickable', false);
        $marker->setOption('flat', true);
        $marker->setOptions(array(
            'clickable' => false,
            'flat'      => true,
        ));

*/

  //      $map->addMarker($marker);

        $newBuddyBaer = new BuddyBaer();
        $form = $this->createBaerForm($newBuddyBaer);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

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
            ->add('name', 'text')
            ->add('description', 'textarea')
            ->add('latitude', 'text')
            ->add('longitude', 'text')
            ->add('file' )
            ->add('save', 'submit')
            ->getForm();
        return $form;
    }
}
