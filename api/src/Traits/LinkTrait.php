<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait LinkTrait
{
	/**
	 * @ORM\Column
	 * @Assert\NotBlank
	 * @Groups({"conference_item"})
	 */
	private $link;

	public function getLink(): string
	{
		return $this->link;
	}

	public function setLink(string $link): self
	{
		$this->link = $link;
		return $this;
	}
}
