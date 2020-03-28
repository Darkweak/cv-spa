<?php

namespace App\Repository;

class ArticleRepository extends TranslatableRepository
{
	public function findAll(string $locale = 'fr')
	{
		$qb = $this->createQueryBuilder('article');

		return $this->getResult($qb, $locale);
	}

	public function findOneByLocale(string $locale = 'fr')
	{
		$qb = $this->createQueryBuilder('article');

		return $this->getSingleResult($qb, $locale);
	}
}
