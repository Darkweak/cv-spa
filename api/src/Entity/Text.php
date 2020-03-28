<?php

namespace App\Entity;

use App\Entity\Translation\TextTranslation;
use App\Repository\TextRepository;
use App\Traits\ArticleTrait;
use App\Traits\IdTrait;
use App\Traits\TranslatableTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * @ORM\Entity(repositoryClass=TextRepository::class)
 * @Gedmo\TranslationEntity(class=TextTranslation::class)
 */
class Text implements Translatable
{
	use IdTrait;
	use ArticleTrait;
	use TranslatableTrait;

	/**
	 * @ORM\ManyToOne(targetEntity=App\Entity\Article::class, inversedBy="texts")
	 */
	private $article;
}
