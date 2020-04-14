<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Traits\DescriptionTrait;
use App\Traits\IdTrait;
use App\Traits\ImageTrait;
use App\Traits\LinkTrait;
use App\Traits\NameTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     	collectionOperations={
 *     		"get"={
 *     			"normalization_context"={"groups"={"site_list"}},
 *     			"security"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"
 *	 		},
 *     		"post"
 *	 	},
 *     	itemOperations={
 *     		"get",
 *     		"patch"={
 *     			"normalization_context"={"groups"={"site_list"}}
 * 			},
 *     		"delete"
 *	 	},
 *    	normalizationContext={"groups"={"site_list"}},
 *     	security="is_granted('ROLE_ADMIN')"
 * )
 * @ORM\Entity
 */
class Site
{
	use IdTrait;
	use DescriptionTrait;
	use ImageTrait;
	use LinkTrait;
	use NameTrait;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="sites")
     * @Assert\NotBlank
     * @Groups({"site_list"})
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function setTags(Collection $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }
        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->remove($tag);
        return $this;
    }
}
