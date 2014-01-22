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

class BaerHelper {

    /**
     *
     * @return @Marker
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
            'clickable' => false,
            'flat'      => true,
        ));

        return $marker;
    }

} 