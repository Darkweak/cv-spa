<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;

trait ImageTrait
{
	/**
	 * @ORM\Column
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
