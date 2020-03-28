<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class SiteRepository extends EntityRepository
{
	public function findAll()
	{
		return $this->findBy([], [
			'id' => 'DESC',
		]);
	}
}
