<?php

namespace VTC\AnnonceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistique
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="VTC\AnnonceBundle\Entity\StatistiqueRepository")
 */
class Statistique
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
     * @var integer
     *
     * @ORM\Column(name="visit", type="integer", nullable=true)
     */
    private $visit = 0;


    /**
     * @var integer
     *
     * @ORM\Column(name="mailsend", type="integer", nullable=true)
     */
    private $mailsend = 0;


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
     * Set visit
     *
     * @param integer $visit
     *
     * @return Statistique
     */
    public function setVisit($visit)
    {
        $this->visit = $visit;

        return $this;
    }

    /**
     * Get visit
     *
     * @return integer
     */
    public function getVisit()
    {
        return $this->visit;
    }

    /**
     * Set mailsend
     *
     * @param integer $mailsend
     *
     * @return Statistique
     */
    public function setMailsend($mailsend)
    {
        $this->mailsend = $mailsend;

        return $this;
    }

    /**
     * Get mailsend
     *
     * @return integer
     */
    public function getMailsend()
    {
        return $this->mailsend;
    }
}

