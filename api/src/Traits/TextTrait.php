<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait TextTrait
{
	/**
	 * @ORM\Column(type="text")
	 * @Assert\NotBlank
	 */
	private $text;

	public function getText(): string
	{
		return $this->text;
	}

	public function setText(string $text): self
	{
		$this->text = $text;
		return $this;
	}
}
