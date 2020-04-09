<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class JobRepository extends EntityRepository
{
	public function findAll()
	{
		return $this->findBy([], [
			'leavedAt' => 'DESC'
		]);
	}
}
