<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait NameTrait
{
	/**
	 * @ORM\Column
	 * @Groups({"article_list", "article_item", "conference_item"})
	 * @Assert\NotBlank
	 */
	private $name;

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name): self
	{
		$this->name = $name;
		return $this;
	}
}
