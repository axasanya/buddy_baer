<?php
/**
 * Created by PhpStorm.
 * User: akszenovicssandor
 * Date: 2014.01.19.
 * Time: 20:53
 */

namespace BuddyBaer\Bundle\ManagerBundle\Helper;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use BuddyBaer\Bundle\ManagerBundle\Entity\BuddyBaer;
use BuddyBaer\Bundle\ManagerBundle\Helper\GpsFileHelper;

class FileHelper {

    /**
     * @var GpsFileHelper
     */
    private $gpsFileHelper;

    public function getImagesAbsolutePath(){
        return __DIR__.'/../../../../../web/images';
    }

    /**
     * @param \BuddyBaer\Bundle\ManagerBundle\Helper\GpsFileHelper $gpsFileHelper
     */
    public function setGpsFileHelper($gpsFileHelper)
    {
        $this->gpsFileHelper = $gpsFileHelper;
    }

    /**
     * @return \BuddyBaer\Bundle\ManagerBundle\Helper\GpsFileHelper
     */
    public function getGpsFileHelper()
    {
        return $this->gpsFileHelper;
    }



    public function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'web/images';
    }

    public function upload(UploadedFile $file)
    {
        // the file property can be empty if the field is not required
        if (null === $file) {
            return;
        }

        $file->move(
            $this->getImagesAbsolutePath(),
            $file->getClientOriginalName()
        );

    }

    /**
     * @param BuddyBaer $baer
     */
    public function getGeoData(BuddyBaer $baer){
        $file = $this->getImagesAbsolutePath() . '/' . $baer->getImageName();

        $location = $this->gpsFileHelper->getCoordinate($file);

        return $location;
    }


} 