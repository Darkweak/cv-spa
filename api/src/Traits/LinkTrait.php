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
	 * @Groups({"category_list", "conference_item", "site_list"})
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
