<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait CityTrait
{
	/**
	 * @ORM\Column
	 * @Groups({"conference_item", "conference_list", "diploma_list", "job_list"})
	 * @Assert\NotBlank
	 */
	private $city;

	/**
	 * @ORM\Column
	 * @Groups({"conference_item", "diploma_list", "job_list"})
	 * @Assert\NotBlank
	 */
	private $cp;

	public function getCity(): string
	{
		return $this->city;
	}

	public function setCity(string $city): self
	{
		$this->city = $city;
		return $this;
	}

	public function getCp(): string
	{
		return $this->cp;
	}

	public function setCp(string $cp): self
	{
		$this->cp = $cp;
		return $this;
	}
}
