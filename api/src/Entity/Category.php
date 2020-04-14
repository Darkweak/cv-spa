<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Traits\IdTrait;
use App\Traits\NameTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     	collectionOperations={
 *     		"get"={
 *     			"normalization_context"={"groups"={"category_list"}},
 *     			"security"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"
 *	 		},
 *     		"post"
 *	 	},
 *     	itemOperations={
 *     		"get",
 *     		"patch"={
 *     			"normalization_context"={"groups"={"category_list"}}
 * 			},
 *     		"delete"
 *	 	},
 *    	normalizationContext={"groups"={"category_list"}},
 *     	security="is_granted('ROLE_ADMIN')"
 * )
 * @ORM\Entity
 */
class Category
{
	use IdTrait;
	use NameTrait;

    /**
     * @ORM\OneToMany(targetEntity="Competence", mappedBy="category")
	 * @Groups({"category_list"})
     */
    private $competences;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
    }

    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function setCompetences(Collection $competences): self
    {
        $this->competences = $competences;
        return $this;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences->add($competence);
        }
        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        $this->competences->remove($competence);
        return $this;
    }
}
