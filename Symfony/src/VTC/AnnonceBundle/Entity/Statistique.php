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
     * @var string
     *
     * @ORM\Column(name="ip", type="string", nullable=true)
     */
    private $ip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastconnect", type="datetime")
     */
    private $lastconnect;
    /**
     * Constructor
     */

    /**
     * Get lastconnect
     *
     * @return DateTime
     */
    public function getLastconnect()
    {
        return $this->lastconnect;
    }

    /**
     * Set lastconnect
     *
     * @param DateTime $lastconnect
     *
     * @return Statistique
     */
    public function setLastconnect($lastconnect)
    {
        $this->lastconnect = $lastconnect;

        return $this;
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
    /**
     * Set Ip
     *
     * @param string $Ip
     *
     * @return Statistique
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get Ip
     *
     * @return string
     */
    public function getip()
    {
        return $this->ip;
    }

    /**
     * Set Id
     *
     * @param integer $Id
     *
     * @return Statistique
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get Id
     *
     * @return integer
     */
    public function getid()
    {
        return $this->id;
    }
    
}

