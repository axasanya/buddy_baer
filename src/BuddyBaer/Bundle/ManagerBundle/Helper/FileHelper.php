<?php
/**
 * Created by PhpStorm.
 * User: akszenovicssandor
 * Date: 2014.01.19.
 * Time: 20:53
 */

namespace BuddyBaer\Bundle\ManagerBundle\Helper;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileHelper {

    public static function getImagesAbsolutePath(){
        return __DIR__.'/../../../../../web/images';
    }

    public static function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'web/images';
    }

    public static  function upload(UploadedFile $file)
    {
        // the file property can be empty if the field is not required
        if (null === $file) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $file->move(
            self::getImagesAbsolutePath(),
            $file->getClientOriginalName()
        );
/*
        var_dump("<pre>",
        $file,
            self::getImagesAbsolutePath()
        );die;*/
    }
} 