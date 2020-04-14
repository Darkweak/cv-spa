<?php

namespace App\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait NameTrait
{
	/**
	 * @ORM\Column
	 * @Groups({
	 *     "article_list",
	 *     "article_item",
	 *     "category_list",
	 *     "conference_item",
	 *     "competence_list",
	 *     "diploma_list",
	 *     "job_list",
	 *     "site_list"
	 * })
	 * @Assert\NotBlank
	 */
	private $name;

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name): self
	{
		$this->name = $name;
		return $this;
	}
}
