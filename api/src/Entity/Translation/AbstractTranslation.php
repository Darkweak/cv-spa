<?php

namespace App\Entity\Translation;

use App\Traits\IdTrait;
use App\Traits\LocaleTrait;
use Doctrine\ORM\Mapping as ORM;
use Locastic\ApiPlatformTranslationBundle\Model\AbstractTranslation as LocasticAbstractTranslation;
use Symfony\Component\Serializer\Annotation\Groups;

abstract class AbstractTranslation extends LocasticAbstractTranslation
{
	use IdTrait;
	use LocaleTrait;

	/**
	 * @ORM\Column(length=2)
	 * @Groups({"article_list", "translations"})
	 */
	protected $locale;
}
