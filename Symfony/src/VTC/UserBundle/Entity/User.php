<?php
// src/OC/UserBundle/Entity/User.php

namespace VTC\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 */
class User extends BaseUser
{	
  /**
   * @ORM\OneToMany(targetEntity="VTC\AnnonceBundle\Entity\Advert", mappedBy="advert")
   * @ORM\JoinColumn(nullable=true)
   */
  private $adverts;

  
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

    
    public function __construct()
    {
        parent::__construct();     
         
        $this->roles = array('ROLE_USER');
      
         
    }

    /**
     * Add advert
     *
     * @param \VTC\AnnonceBundle\Entity\Advert $advert
     *
     * @return User
     */
    public function addAdvert(\VTC\AnnonceBundle\Entity\Advert $advert)
    {
        $this->adverts[] = $advert;

        return $this;
    }

    /**
     * Remove advert
     *
     * @param \VTC\AnnonceBundle\Entity\Advert $advert
     */
    public function removeAdvert(\VTC\AnnonceBundle\Entity\Advert $advert)
    {
        $this->adverts->removeElement($advert);
    }

    /**
     * Get adverts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdverts()
    {
        return $this->adverts;
    }
}
