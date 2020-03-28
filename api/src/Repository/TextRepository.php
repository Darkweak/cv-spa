<?php

namespace App\Repository;

class TextRepository extends TranslatableRepository
{
	public function findAll(string $locale = 'fr'): array
	{
		$qb = $this->createQueryBuilder('text');

		return $this->getResult($qb, $locale);
	}
}
