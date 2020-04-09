<?php

namespace App\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait TitleTrait
{
	/**
	 * @ORM\Column
	 * @Groups({"article_list", "article_item", "translations"})
	 */
	private $title;

	public function getTitle(): ?string
	{
		return $this->title;
	}

	public function setTitle(string $title): self
	{
		$this->title = $title;
		return $this;
	}
}
