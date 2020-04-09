<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

trait TranslatableSluggableTrait
{
	private $slug;

	public function getSlug(): string
	{
		return $this->getTranslation()->getSlug();
	}

	public function setSlug(string $slug): self
	{
		$this->getTranslation()->setSlug($slug);
		return $this;
	}
}
