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

	public function addVisit()
	{
		
		$visit = new Statistique();

   		$addvisit = $visit->getVisit();
    	$addvisit ++;

	    $visit->setVisit($addvisit);
	    $this->em->persist($visit);
	    
	    $this->em->flush();
	}



}