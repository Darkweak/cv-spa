<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Translation\ArticleTranslation;
use App\Traits\IdTrait;
use App\Traits\ImageTrait;
use App\Traits\TimestampableTrait;
use App\Traits\TranslatableSluggableTrait;
use App\Traits\TranslatableTitleTrait;
use App\Traits\TranslatableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Locastic\ApiPlatformTranslationBundle\Model\AbstractTranslatable;
use Locastic\ApiPlatformTranslationBundle\Model\TranslationInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     	collectionOperations={
 *     		"get"={
 *     			"normalization_context"={"groups"={"article_list"}}
 *	 		},
 *     		"post"={
 *     			"security"={"is_granted('ROLE_ADMIN')"}
 * 			}
 *	 	},
 *     	itemOperations={
 *     		"get"={
 *     			"normalization_context"={"groups"={"article_item"}}
 *	 		},
 *     		"patch"={
 *     			"security"="is_granted('ROLE_ADMIN')",
 *     			"normalization_context"={"groups"={"conference_list"}}
 * 			},
 *     		"delete"={
 *     			"security"="is_granted('ROLE_ADMIN')",
 *     			"normalization_context"={"groups"={"conference_list"}}
 * 			}
 *	 	},
 *    	normalizationContext={"groups"={"article_list"}}
 * )
 * @ORM\Entity
 */
class Article extends AbstractTranslatable
{
	use IdTrait;
	use ImageTrait;
	use TimestampableTrait;
	use TranslatableTitleTrait;
	use TranslatableSluggableTrait;
	use TranslatableTrait;

	/**
	 * @ORM\OneToMany(targetEntity=CodePackage::class, mappedBy="article")
	 * @Groups({"article_item"})
	 */
	private $codePackages;

	/**
	 * @ORM\OneToMany(targetEntity=Text::class, mappedBy="article")
	 * @Groups({"article_item"})
	 */
	private $texts;

	/**
	 * @Groups({"article_list", "article_item", "translations"})
	 * @ORM\OneToMany(targetEntity=ArticleTranslation::class, mappedBy="translatable", cascade={"persist", "remove"}, orphanRemoval=true)
	 */
	protected $translations;

	public function __construct()
	{
		parent::__construct();
		$this->translations = new ArrayCollection();
		$this->codePackages = new ArrayCollection();
		$this->texts = new ArrayCollection();
	}

	public function getCodePackages(): Collection
	{
		return $this->codePackages;
	}

	public function setCodePackages(Collection $codePackages): self
	{
		$this->codePackages = $codePackages;
		return $this;
	}

	public function addCodePackage(CodePackage $codePackage): self
	{
		if (!$this->codePackages->contains($codePackage)) {
			$this->codePackages->add($codePackage);
		}
		return $this;
	}

	public function removeCodePackage(CodePackage $codePackage): self
	{
		$this->codePackages->removeElement($codePackage);
		return $this;
	}

	public function getTexts(): Collection
	{
		return $this->texts;
	}

	public function setTexts(Collection $texts): self
	{
		$this->texts = $texts;
		return $this;
	}

	public function addText(Text $text): self
	{
		if (!$this->texts->contains($text)) {
			$this->texts->add($text);
		}
		return $this;
	}

	public function removeText(Text $text): self
	{
		$this->texts->removeElement($text);
		return $this;
	}

	protected function createTranslation(): TranslationInterface
	{
		return new ArticleTranslation();
	}
}
