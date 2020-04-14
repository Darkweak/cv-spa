<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Traits\IdTrait;
use App\Traits\LinkTrait;
use App\Traits\NameTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     	collectionOperations={
 *     		"get"={
 *     			"normalization_context"={"groups"={"competence_list"}}
 *	 		}
 *	 	},
 *     	itemOperations={
 *     		"get"={
 *     			"normalization_context"={"groups"={"competence_item"}}
 *	 		},
 *     		"patch"={
 *     			"normalization_context"={"groups"={"competence_list"}}
 * 			},
 *     		"delete"
 *	 	},
 *    	normalizationContext={"groups"={"competence_list"}},
 *     	security="is_granted('ROLE_ADMIN')"
 * )
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
