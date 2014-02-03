<?php
/**
 * Created by PhpStorm.
 * User: akszenovicssandor
 * Date: 2014.01.21.
 * Time: 23:09
 */

namespace BuddyBaer\Bundle\ManagerBundle\Helper;

use BuddyBaer\Bundle\ManagerBundle\BuddyBaerManagerBundle;
use BuddyBaer\Bundle\ManagerBundle\Entity\BuddyBaer;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\GoogleMap\Events\MouseEvent;

class BaerHelper {

    /**
     * @param BuddyBaer $baer
     * @return Marker
     */
    public static function getMarker(BuddyBaer $baer){
        /** @var Marker */
        $marker = new Marker();
        $marker->setPrefixJavascriptVariable('marker_');
        $marker->setPosition( $baer->getLatitude() ,$baer->getLongitude(), true);
        $marker->setAnimation(Animation::DROP);

        $marker->setOption('clickable', false);
        $marker->setOption('flat', true);
        $marker->setOptions(array(
            'clickable' => true,
            'flat'      => true,
        ));


        $infoWindow = new InfoWindow();

        $content = '<div class="span12"><img src="http://buddybaer/images/' . $baer->getImageName() . '" width="150px" /></div>';

        $infoWindow->setPrefixJavascriptVariable('info_window_');
        $infoWindow->setPosition(0, 0, true);
        $infoWindow->setPixelOffset(1.1, 2.1, 'px', 'pt');
        $infoWindow->setContent($content);
        $infoWindow->setOpen(false);
        $infoWindow->setAutoOpen(true);
        $infoWindow->setOpenEvent(MouseEvent::CLICK);
        $infoWindow->setAutoClose(false);
        $infoWindow->setOption('disableAutoPan', true);
        $infoWindow->setOption('zIndex', 10);
        $infoWindow->setOptions(array(
            'disableAutoPan' => true,
            'zIndex'         => 10,
        ));
        $marker->setInfoWindow($infoWindow);


        return $marker;
    }



} 