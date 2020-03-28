<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait TypeTrait
{
	/**
	 * @ORM\Column
	 * @Assert\NotBlank
	 */
	private $type;

	public function getName(): string
	{
		return $this->type;
	}

	public function setName(string $type): self
	{
		$this->type = $type;
		return $this;
	}
}
