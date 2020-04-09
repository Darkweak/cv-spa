<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait ContentTrait
{
	/**
	 * @ORM\Column(type="text")
	 * @Assert\NotBlank
	 * @Groups({"article_list", "article_item"})
	 */
	private $content;

	public function getContent(): string
	{
		return $this->content;
	}

	public function setContent(string $content): self
	{
		$this->content = $content;
		return $this;
	}
}
