<?php

namespace App\Entity;

use App\Entity\Translation\ArticleTranslation;
use App\Repository\ArticleRepository;
use App\Traits\IdTrait;
use App\Traits\ImageTrait;
use App\Traits\SluggableTrait;
use App\Traits\TranslatableTitleTrait;
use App\Traits\TranslatableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * @ORM\Entity
 * @Gedmo\TranslationEntity(class=ArticleTranslation::class)
 */
class Article implements Translatable
{
	use IdTrait;
	use ImageTrait;
	use TranslatableTitleTrait;
	use TranslatableTrait;
	use SluggableTrait;

	/**
	 * @ORM\OneToMany(targetEntity=CodePackage::class, mappedBy="article")
	 */
	private $codePackages;

	/**
	 * @ORM\OneToMany(targetEntity=Text::class, mappedBy="article")
	 */
	private $texts;

	public function __construct()
	{
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
}
