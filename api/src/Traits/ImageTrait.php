<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait ImageTrait
{
	/**
	 * @ORM\Column
	 * @Groups({"article_list", "conference_item", "conference_list", "site_list"})
	 */
	private $image;

	public function getImage(): ?string
	{
		return $this->image;
	}

	public function setImage(?string $image): self
	{
		$this->image = $image;
		return $this;
	}
}
