<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait DescriptionTrait
{
	/**
	 * @ORM\Column(type="text")
	 * @Groups({"article_list", "article_item"})
	 * @Assert\NotBlank
	 */
	private $description;

	public function getDescription(): string
	{
		return $this->description;
	}

	public function setDescription(string $description): self
	{
		$this->description = $description;
		return $this;
	}
}
