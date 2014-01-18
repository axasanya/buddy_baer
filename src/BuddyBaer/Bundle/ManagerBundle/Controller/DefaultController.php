<?php

namespace BuddyBaer\Bundle\ManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;



class DefaultController extends Controller
{
    public function indexAction()
    {
        /** @var Ivory\GoogleMapBundle\Entity\Map */
        $map = $this->get('ivory_google_map.map');

        $markerFromConfig = $this->get('ivory_google_map.marker');
        $map->addMarker($markerFromConfig);


        $marker = new Marker();
// Configure your marker options
        $marker->setPrefixJavascriptVariable('marker_');
        $marker->setPosition( 52.5343700,13.4305300, true);
        $marker->setAnimation(Animation::DROP);

        $marker->setOption('clickable', false);
        $marker->setOption('flat', true);
        $marker->setOptions(array(
            'clickable' => false,
            'flat'      => true,
        ));

        $map->addMarker($marker);

       // var_dump("<pre>", $map);die;

        return $this->render('BuddyBaerManagerBundle:Default:index.html.twig',
            array('map' => $map,
               // 'marker' => $marker
        ));
    }
}
