<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait TranslatableTrait
{
	/**
	 * @Gedmo\Translatable
	 * @ORM\Column(type="text")
	 */
	private $content;

	/**
	 * @Gedmo\Locale
	 */
	private $locale;

	public function getContent(): string
	{
		return $this->content;
	}

	public function setContent(string $content)
	{
		$this->content = $content;
	}

	public function setTranslatableLocale(string $locale)
	{
		$this->locale = $locale;
	}
}
