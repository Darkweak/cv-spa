<?php

namespace App\Traits;

trait TranslatableTitleTrait
{
	private $title;

	public function getTitle(): ?string
	{
		return $this->getTranslation()->getTitle();
	}

	public function setTitle(string $title): self
	{
		$this->getTranslation()->setTitle($title);
		return $this;
	}
}
