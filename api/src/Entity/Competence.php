<?php

namespace App\Entity;

use App\Traits\IdTrait;
use App\Traits\LinkTrait;
use App\Traits\NameTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Competence
{
	use IdTrait;
	use NameTrait;
	use LinkTrait;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="competences")
     */
    private $category;

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;
        return $this;
    }
}
