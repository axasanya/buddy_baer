<?php

namespace BuddyBaer\Bundle\ManagerBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use BuddyBaer\Bundle\ManagerBundle\Helper\FileHelper;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation\ExclusionPolicy as JsonSerializationExclusionPolicy;
use JMS\Serializer\Annotation\Exclude as ExcludeFromJsonSerialization;

/**
 * BuddyBaer
 *
 * @ORM\Table("buddy_baer")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 *
 * @JsonSerializationExclusionPolicy("NONE")
 */
class BuddyBaer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=true )
     *
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", nullable=true )
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float",nullable=true )
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="image_name", type="string", length=128, nullable=true )
     */
    private $imageName;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true )
     */
    private $description;

    /**
     * @var FileHelper
     *
     */
    private $fileHelper;

    /**
     * @param mixed $fileHelper
     */
    public function setFileHelper($fileHelper)
    {
        $this->fileHelper = $fileHelper;
    }

    /**
     * @return mixed
     */
    public function getFileHelper()
    {
        return $this->fileHelper;
    }


    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : FileHelper::getImagesAbsolutePath().'/'.$this->imageName;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    /**
     * @Assert\File(maxSize="6000000")
     *
     */
    private $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function upload(){

        $this->fileHelper->upload($this->file);

        // set the path property to the filename where you've saved the file
        $this->imageName = $this->file->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return BuddyBaer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     * @return BuddyBaer
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return BuddyBaer
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     * @return BuddyBaer
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string 
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return BuddyBaer
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @ORM\PrePersist
     */
    public function trySetLatitudeFromFileIfEmpty()
    {
        if(!$this->latitude || !$this->longitude){
            $location = $this->fileHelper->getGeoData($this);
            $this->setLatitude($location['latitude']);
            $this->setLongitude($location['longitude']);
        }
    }
}
