<?php

namespace VTC\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class UserRepository extends \Doctrine\ORM\EntityRepository
{
  public function getUserAdvert()
	{
		$qb = $this->createQueryBuilder('a')
		->addOrderBy('a.date', 'DESC');


    return $qb->getQuery()->getResult();
	}
}




