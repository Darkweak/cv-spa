<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait DateTrait
{
	/**
	 * @ORM\Column(type="date")
	 * @Assert\NotBlank
	 */
	private $date;

	public function getDate(): \DateTime
	{
		return $this->date;
	}

	public function setDate(\DateTime $date): self
	{
		$this->date = $date;
		return $this;
	}
}
