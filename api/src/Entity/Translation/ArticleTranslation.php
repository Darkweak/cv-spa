<?php

namespace App\Entity\Translation;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;

/**
 * @ORM\Table(name="translations_article", indexes={
 *      @ORM\Index(name="article_translation_idx", columns={"locale", "object_class", "field", "foreign_key"})
 * })
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class ArticleTranslation extends AbstractTranslation
{
	/**
	 * @var string $id
	 *
	 * @ORM\Column
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="UUID")
	 */
	protected $id;

	public function getId(): string
	{
		return $this->id;
	}
}
