<?php

namespace App\Traits;


trait TranslatableTrait
{
	protected $translations;

	public function getTranslations()
	{
		return $this->translations;
	}
}
