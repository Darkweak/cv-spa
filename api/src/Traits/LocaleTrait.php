<?php

namespace App\Traits;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait LocaleTrait {
	public function getLocale(): ?string
	{
		return $this->locale;
	}

	public function setLocale(?string $locale): void
	{
		$this->locale = $locale;
	}
}
