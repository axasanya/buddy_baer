<?php
/**
 * Created by PhpStorm.
 * User: akszenovicssandor
 * Date: 2014.01.25.
 * Time: 0:41
 */

namespace BuddyBaer\Bundle\ManagerBundle\Helper;


class GpsFileHelper
{

    /**
     * @var string
     */
    private $_gpsLatitude;

    /**
     * @var string
     */
    private $_gpsLongitude;

    /**
     * @var string
     */
    private $_gpsLatitudeRef;

    /**
     * @var string
     */
    private $_gpsLongitudeRef;

    /**
     * Constructor Method
     */
    public function __construct()
    {
        /**
         * GPS Meta (In reference to iphone's image file)
         */
        $this->_gpsLatitude = 'GPSLatitude';
        $this->_gpsLongitude = 'GPSLongitude';
        $this->_gPSLongitudeRef = 'GPSLatitudeRef';
        $this->_gpsLongitudeRef = 'GPSLongitudeRef';
    }

    /**
     * Check if the file contains GPS information
     * @param: (string)$file
     * @return: (array) File's EXIF data (If the file contains GPS information)
     */

    public function getCoordinate($file)
    {
        $_Metas = $this->checkGPS($file);
        $_GPS = $_Metas['GPS'];
        $latitude = $this->DMStoDEC(
            $_GPS[$this->_gpsLatitude][0],
            $_GPS[$this->_gpsLatitude][1],
            $_GPS[$this->_gpsLatitude][2],
            $_GPS[$this->_gPSLongitudeRef]
        );
        $longitude = $this->DMStoDEC(
            $_GPS[$this->_gpsLongitude][0],
            $_GPS[$this->_gpsLongitude][1],
            $_GPS[$this->_gpsLongitude][2],
            $_GPS[$this->_gpsLongitudeRef]
        );

        $location = array(
            'latitude' => $latitude, 
            'longitude' => $longitude
        );
        return $location;
    }

    /**
     * Check if the file contains GPS information
     * @param: (string)$file
     * @return: (array) File's EXIF data (If the file contains GPS information)
     */
    public function checkGPS($file)
    {
        return exif_read_data($file, 'GPS', true);
    }

    /**
     * Get Meta information of file
     * @param: (string)$file
     * @return: (array) File's EXIF data
     *
     */
    public function getExif($file)
    {
        return exif_read_data($file, 'IFD0', true);
    }

    /**
     * Converts DMS ( Degrees / Minutes / Seconds )
     * To decimal format longitude / latitude
     * @param: (string)$_deg, (string)$_min, (string)$_sec, (string)$_ref
     * @return: (float)
     */
    private function DMStoDEC($_deg, $_min, $_sec, $_ref)
    {

        $_array = explode('/', $_deg);
        $_deg = $_array[0] / $_array[1];
        $_array = explode('/', $_min);
        $_min = $_array[0] / $_array[1];
        $_array = explode('/', $_sec);
        $_sec = $_array[0] / $_array[1];

        $_coordinate = $_deg + ((($_min * 60) + ($_sec)) / 3600);
        /**
         *  + + = North/East
         *  + - = North/West
         *  - - = South/West
         *  - + = South/East
         */
        if ('s' === strtolower($_ref) || 'w' === strtolower($_ref)) {
            // Negatify the coordinate
            $_coordinate = 0 - $_coordinate;
        }

        return $_coordinate;
    }

    /**
     *
     * Converts decimal longitude / latitude to DMS
     * ( Degrees / minutes / seconds )
     *
     * This is the piece of code which may appear to
     * be inefficient, but to avoid issues with floating
     * point math we extract the integer part and the float
     * part by using a string function.
     * @param: (string)$file
     * @return: (array)
     */
    private function DECtoDMS($_dec)
    {
        $_vars = explode(".", $_dec);
        $_deg = $vars[0];
        $_tempma = "0." . $_vars[1];

        $_tempma = $_tempma * 3600;
        $_min = floor($_tempma / 60);
        $_sec = $_tempma - ($_min * 60);

        return array("deg" => $_deg, "min" => $_min, "sec" => $_sec);
    }

} 