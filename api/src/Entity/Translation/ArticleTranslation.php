<?php

namespace App\Entity\Translation;

use App\Entity\Article;
use App\Traits\SluggableTrait;
use App\Traits\TitleTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="translations_article")
 * @ORM\Entity
 */
class ArticleTranslation extends AbstractTranslation
{
	use SluggableTrait;
	use TitleTrait;

	/**
	 * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="translations")
	 * @ORM\JoinColumn(name="article_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $translatable;
}
