<?php

namespace App\Entity;

use App\Entity\Translation\TextTranslation;
use App\Traits\ArticleTrait;
use App\Traits\IdTrait;
use App\Traits\TimestampableTrait;
use App\Traits\TranslatableDescriptionTrait;
use Doctrine\ORM\Mapping as ORM;
use Locastic\ApiPlatformTranslationBundle\Model\AbstractTranslatable;
use Locastic\ApiPlatformTranslationBundle\Model\TranslationInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 */
class Text extends AbstractTranslatable
{
	use IdTrait;
	use ArticleTrait;
	use TimestampableTrait;
	use TranslatableDescriptionTrait;

	/**
	 * @ORM\ManyToOne(targetEntity=App\Entity\Article::class, inversedBy="texts")
	 */
	private $article;

	/**
	 * @Groups({"article_list", "translations"})
	 * @ORM\OneToMany(targetEntity=TextTranslation::class, mappedBy="translatable", cascade={"persist", "remove"}, orphanRemoval=true)
	 */
	protected $translations;

	protected function createTranslation(): TranslationInterface
	{
		return new TextTranslation();
	}
}
