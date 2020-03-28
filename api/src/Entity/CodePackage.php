<?php

namespace App\Entity;

use App\Traits\ArticleTrait;
use App\Traits\IdTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class CodePackage
{
	use IdTrait;
	use ArticleTrait;

	/**
	 * @ORM\ManyToOne(targetEntity=App\Entity\Article::class, inversedBy="codePackages")
	 */
	private $article;

	/**
	 * @ORM\OneToMany(targetEntity=Code::class, mappedBy="codePackage")
	 */
	private $codes;

	public function __construct()
	{
		$this->codes = new ArrayCollection();
	}

	public function getCodes(): Collection
	{
		return $this->codes;
	}

	public function setCodes(Collection $codes): self
	{
		$this->codes = $codes;
		return $this;
	}

	public function addCode(Code $code): self
	{
		if (!$this->codes->contains($code)) {
			$this->codes->add($code);
		}
		return $this;
	}

	public function removeCode(Code $code): self
	{
		$this->codes->removeElement($code);
		return $this;
	}
}
