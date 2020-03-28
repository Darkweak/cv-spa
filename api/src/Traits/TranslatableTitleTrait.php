<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait TranslatableTitleTrait
{
	/**
	 * @Gedmo\Translatable
	 * @ORM\Column
	 */
	private $title;

	public function getTitle(): string
	{
		return $this->title;
	}

	public function setTitle(string $title): self
	{
		$this->title = $title;
		return $this;
	}
}
