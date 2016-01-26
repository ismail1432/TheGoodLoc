<?php


namespace VTC\AnnonceBundle\Stats;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use VTC\AnnonceBundle\Entity\Statistique;


class VTCStats
{
	private $em;
	public function __construct(\Doctrine\ORM\EntityManager $em)
	{
		$this->em = $em;

	}

	public function addVisit($ip)
	{
		$visit = $this->em->getRepository('VTCAnnonceBundle:Statistique')->findOneByIp($ip);
   		$addvisit = $visit->getVisit();
    	$addvisit ++;
    	$visit->setIp($ip);
	    $visit->setVisit($addvisit);
	    $visit->setLastconnect(new \Datetime());
	    $this->em->persist($visit);
	    
	    $this->em->flush();
	}
	public function addMailsend($ip)
	{
		$visit = $this->em->getRepository('VTCAnnonceBundle:Statistique')->findOneByIp($ip);
   		$addmail = $visit->getMailsend();
    	$addmail ++;
	    $visit->setMailsend($addmail);
	    $this->em->persist($visit);
	    
	    $this->em->flush();
	}

	public function addVisitor($ip)
	{
		
		$visit = new Statistique();

    	$visit->setIp($ip);
    	$visit->setLastconnect(new \Datetime());
	    $visit->setVisit(1);
	    $this->em->persist($visit);
	    
	    $this->em->flush();
	}

	public function compare($datenow, $lastdate)
	{
		if((strtotime($datenow) - (strtotime($lastdate))) > 18000) 
		{
			return true;
		}
	}



}