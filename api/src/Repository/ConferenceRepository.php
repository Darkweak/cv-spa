<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class ConferenceRepository extends EntityRepository
{
	public function findAll()
	{
		return $this->findBy([], [
			'name' => 'DESC',
		]);
	}
}
