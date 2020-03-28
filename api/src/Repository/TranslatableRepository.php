<?php

namespace App\Repository;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Gedmo\Translatable\Query\TreeWalker\TranslationWalker;
use Gedmo\Translatable\TranslatableListener;

class TranslatableRepository extends EntityRepository
{
	protected $defaultLocale;

	public function setDefaultLocale(string $locale)
	{
		$this->defaultLocale = $locale;
	}

	public function getOneOrNullResult(QueryBuilder $qb, string $locale = null, string $hydrationMode = null): QueryBuilder
	{
		return $this->getTranslatedQuery($qb, $locale)->getOneOrNullResult($hydrationMode);
	}

	public function getResult(QueryBuilder $qb, string $locale = null, string $hydrationMode = AbstractQuery::HYDRATE_OBJECT): array
	{
		return $this->getTranslatedQuery($qb, $locale)->getResult($hydrationMode);
	}

	public function getArrayResult(QueryBuilder $qb, string $locale = null): QueryBuilder
	{
		return $this->getTranslatedQuery($qb, $locale)->getArrayResult();
	}

	public function getSingleResult(QueryBuilder $qb, string $locale = null, string $hydrationMode = null): QueryBuilder
	{
		return $this->getTranslatedQuery($qb, $locale)->getSingleResult($hydrationMode);
	}

	public function getScalarResult(QueryBuilder $qb, string $locale = null): QueryBuilder
	{
		return $this->getTranslatedQuery($qb, $locale)->getScalarResult();
	}

	public function getSingleScalarResult(QueryBuilder $qb, string $locale = null): QueryBuilder
	{
		return $this->getTranslatedQuery($qb, $locale)->getSingleScalarResult();
	}

	protected function getTranslatedQuery(QueryBuilder $qb, $locale = null): Query
	{
		$locale = null === $locale ? $this->defaultLocale : $locale;

		$query = $qb->getQuery();

		$query->setHint(Query::HINT_CUSTOM_OUTPUT_WALKER, TranslationWalker::class);
		$query->setHint(TranslatableListener::HINT_TRANSLATABLE_LOCALE, $locale);
		$query->setHint(TranslatableListener::HINT_FALLBACK, 0);
		$query->setHint(TranslatableListener::HINT_INNER_JOIN, true);

		return $query;
	}
}
