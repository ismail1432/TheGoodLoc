<?php

namespace VTC\AnnonceBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Advert
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="VTC\AnnonceBundle\Entity\AdvertRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Advert
{


   /**
   * @ORM\ManyToOne(targetEntity="VTC\UserBundle\Entity\User", inversedBy="adverts")
   * @ORM\JoinColumn(nullable=false)
   */
  private $user;


    /**
    * @ORM\OneToMany(targetEntity="VTC\AnnonceBundle\Entity\Image", mappedBy="advert", cascade={"persist", "remove"})
    */
  private $images;





    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="dept", type="string", length=255,)
     */
    private $dept;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * @Assert\Length(min = "2",
     *                max = 25,
     *                 minMessage = " le titre doit contenir minimum {{ limit }} lettres",
     *                 maxMessage = " le titre doit contenir maximum {{ limit }} lettres")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="modele", type="string", length=255, nullable=false)
     *@Assert\Length(min = "3",
     *                max = 25,
     *                 minMessage = " le modele doit contenir minimum {{ limit }} lettres",
     *                 maxMessage = " le modele doit contenir maximum {{ limit }} lettres")
     */
    private $modele;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255, nullable=false)
     */
    private $categorie;

    /**
     * @var boolean
     *
     * @ORM\Column(name="assurance", type="boolean")
     */
    private $assurance;

    /**
     * @var smallint
     *
     * @ORM\Column(name="pricejour", type="smallint", nullable=true)
     * @Assert\Range(
     *      max = 1500,
     *      maxMessage = " {{ 1500 }} euros maximum !"
     * )
     */
    private $pricejour;

    /**
     * @var boolean
     *
     * @ORM\Column(name="locjour", type="boolean")
     */
    private $locjour;

    /**
     * @var smallint
     *
     * @ORM\Column(name="pricehebdo", type="smallint", nullable=true)
     * @Assert\Range(
     *      max = 5000,
     *      maxMessage = " {{ 5000 }} euros maximum !"
     * )
     */
    private $pricehebdo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lochebdo", type="boolean", nullable=true)
     */
    private $lochebdo;

    /**
     * @var smallint
     *
     * @ORM\Column(name="pricemensuel",  nullable=true, type="smallint", nullable=true)
     * @Assert\Range(
     *      max = 22250,
     *      maxMessage = " 22250 euros maximum !"
     * )
     */
    private $pricemensuel;

    /**
     * @var boolean
     *
     * @ORM\Column(name="locmensuel", type="boolean", nullable=true)
     */
    private $locmensuel;

    /**
     * @var boolean
     *
     * @ORM\Column(name="doublagebool", type="boolean")
     */
    private $doublagebool;

    /**
     * @var boolean
     *
     * @ORM\Column(name="valid", type="boolean")
     */
    private $valid = false;

    /**
     * @var string
     *
     * @ORM\Column(name="doublage", length=255, nullable=true)
     */
    private $doublage;

    /**
     * @var smallint
     *
     * @ORM\Column(name="kilometres", type="smallint", nullable=true)
     * @Assert\Range(
     *      max = 250000,
     *      maxMessage = " {{ limit }} kms maximum !"
     * )
     */
    
    private $kilometres;

    /**
     * @var smallint
     *
     * @ORM\Column(name="kilometremax", type="smallint", nullable=true)
     */
    private $kilometremax;

    /**
     * @var string
     *
     * @ORM\Column(name="energie", type="string", length=255, nullable=true)
     */
    private $energie;

    /**
     * @var string
     *
     * @ORM\Column(name="boitevitesse", type="string", nullable=true, length=255)
     */
    private $boitevitesse;

    /**
     * @var string
     *
     * @ORM\Column(name="interieur", type="string", nullable=true, length=255)
     */
    private $interieur;

    /**
     * @var text
     *
     * @ORM\Column(name="comments", nullable=true, type="text")
     */
    private $comments;

    /**
     * @var string
     *
     * @ORM\Column(name="mois", type="string", nullable=true)
     */
    private $mois;


    /**
     * @var smallint
     *
     * @ORM\Column(name="annee", type="smallint", nullable=true)
     */
    private $annee;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
   
        $this->date = new \Datetime();

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Advert
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set dept
     *
     * @param integer $dept
     *
     * @return Advert
     */
    public function setDept($dept)
    {
        $this->dept = $dept;

        return $this;
    }

    /**
     * Get dept
     *
     * @return integer
     */
    public function getDept()
    {
        return $this->dept;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Advert
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set modele
     *
     * @param string $modele
     *
     * @return Advert
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return string
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Advert
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set assurance
     *
     * @param string $assurance
     *
     * @return Advert
     */
    public function setAssurance($assurance)
    {
        $this->assurance = $assurance;

        return $this;
    }

    /**
     * Get assurance
     *
     * @return string
     */
    public function getAssurance()
    {
        return $this->assurance;
    }

    /**
     * Set pricejour
     *
     * @param integer $pricejour
     *
     * @return Advert
     */
    public function setPricejour($pricejour)
    {
        $this->pricejour = $pricejour;

        return $this;
    }

    /**
     * Get pricejour
     *
     * @return integer
     */
    public function getPricejour()
    {
        return $this->pricejour;
    }

    /**
     * Set locjour
     *
     * @param boolean $locjour
     *
     * @return Advert
     */
    public function setLocjour($locjour)
    {
        $this->locjour = $locjour;

        return $this;
    }

    /**
     * Get locjour
     *
     * @return boolean
     */
    public function getLocjour()
    {
        return $this->locjour;
    }

    /**
     * Set pricehebdo
     *
     * @param integer $pricehebdo
     *
     * @return Advert
     */
    public function setPricehebdo($pricehebdo)
    {
        $this->pricehebdo = $pricehebdo;

        return $this;
    }

    /**
     * Get pricehebdo
     *
     * @return integer
     */
    public function getPricehebdo()
    {
        return $this->pricehebdo;
    }

    /**
     * Set lochebdo
     *
     * @param boolean $lochebdo
     *
     * @return Advert
     */
    public function setLochebdo($lochebdo)
    {
        $this->lochebdo = $lochebdo;

        return $this;
    }

    /**
     * Get lochebdo
     *
     * @return boolean
     */
    public function getLochebdo()
    {
        return $this->lochebdo;
    }

    /**
     * Set pricemensuel
     *
     * @param integer $pricemensuel
     *
     * @return Advert
     */
    public function setPricemensuel($pricemensuel)
    {
        $this->pricemensuel = $pricemensuel;

        return $this;
    }

    /**
     * Get pricemensuel
     *
     * @return integer
     */
    public function getPricemensuel()
    {
        return $this->pricemensuel;
    }

    /**
     * Set locmensuel
     *
     * @param boolean $locmensuel
     *
     * @return Advert
     */
    public function setLocmensuel($locmensuel)
    {
        $this->locmensuel = $locmensuel;

        return $this;
    }

    /**
     * Get locmensuel
     *
     * @return boolean
     */
    public function getLocmensuel()
    {
        return $this->locmensuel;
    }

    /**
     * Set doublagebool
     *
     * @param boolean $doublagebool
     *
     * @return Advert
     */
    public function setDoublagebool($doublagebool)
    {
        $this->doublagebool = $doublagebool;

        return $this;
    }

    /**
     * Get doublagebool
     *
     * @return boolean
     */
    public function getDoublagebool()
    {
        return $this->doublagebool;
    }

    /**
     * Set doublage
     *
     * @param string $doublage
     *
     * @return Advert
     */
    public function setDoublage($doublage)
    {
        $this->doublage = $doublage;

        return $this;
    }

    /**
     * Get doublage
     *
     * @return string
     */
    public function getDoublage()
    {
        return $this->doublage;
    }

    /**
     * Set kilometres
     *
     * @param integer $kilometres
     *
     * @return Advert
     */
    public function setKilometres($kilometres)
    {
        $this->kilometres = $kilometres;

        return $this;
    }

    /**
     * Get kilometres
     *
     * @return integer
     */
    public function getKilometres()
    {
        return $this->kilometres;
    }

    /**
     * Set energie
     *
     * @param string $energie
     *
     * @return Advert
     */
    public function setEnergie($energie)
    {
        $this->energie = $energie;

        return $this;
    }

    /**
     * Get energie
     *
     * @return string
     */
    public function getEnergie()
    {
        return $this->energie;
    }

    /**
     * Set boitevitesse
     *
     * @param string $boitevitesse
     *
     * @return Advert
     */
    public function setBoitevitesse($boitevitesse)
    {
        $this->boitevitesse = $boitevitesse;

        return $this;
    }

    /**
     * Get boitevitesse
     *
     * @return string
     */
    public function getBoitevitesse()
    {
        return $this->boitevitesse;
    }

    /**
     * Set interieur
     *
     * @param string $interieur
     *
     * @return Advert
     */
    public function setInterieur($interieur)
    {
        $this->interieur = $interieur;

        return $this;
    }

    /**
     * Get interieur
     *
     * @return string
     */
    public function getInterieur()
    {
        return $this->interieur;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return Advert
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    

    /**
     * Add image
     *
     * @param \VTC\AnnonceBundle\Entity\Image $image
     *
     * @return Advert
     */
    public function addImage(\VTC\AnnonceBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \VTC\AnnonceBundle\Entity\Image $image
     */
    public function removeImage(\VTC\AnnonceBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set kilometremax
     *
     * @param integer $kilometremax
     *
     * @return Advert
     */
    public function setKilometremax($kilometremax)
    {
        $this->kilometremax = $kilometremax;

        return $this;
    }

    /**
     * Get kilometremax
     *
     * @return integer
     */
    public function getKilometremax()
    {
        return $this->kilometremax;
    }

    /**
     * Set valid
     *
     * @param boolean $valid
     *
     * @return Advert
     */
    public function setValid($valid)
    {
        $this->valid = $valid;

        return $this;
    }

    /**
     * Get valid
     *
     * @return boolean
     */
    public function getValid()
    {
        return $this->valid;
    }

    public function getWebPath()
  {
    return $this->getUploadDir().'/'.$this->getId().'.'.$this->getUrl();
  }



    /**
     * Set annee
     *
     * @param integer $annee
     *
     * @return Advert
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return integer
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set mois
     *
     * @param string $mois
     *
     * @return Advert
     */
    public function setMois($mois)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get mois
     *
     * @return string
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set user
     *
     * @param \VTC\UserBundle\Entity\User $user
     *
     * @return Advert
     */
    public function setUser(\VTC\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \VTC\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
   * @ORM\PrePersist
   */
  public function increase()
  {
    $this->getUser()->increaseAdvert();
  }

  /**
   * @ORM\PreRemove
   */
  public function decrease()
  {
    $this->getUser()->decreaseAdvert();
  }
}
