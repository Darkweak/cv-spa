<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait SluggableTrait
{
	/**
	 * @Gedmo\Slug(fields={"title"})
	 * @Gedmo\Translatable
	 * @ORM\Column(unique=true)
	 */
	private $slug;

	public function getSlug(): string
	{
		return $this->slug;
	}

	public function setSlug(string $slug): self
	{
		$this->slug = $slug;
		return $this;
	}
}
