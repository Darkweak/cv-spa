<?php

namespace App\Entity;

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
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="sites")
     * @Assert\NotBlank
     * @Groups({"get_collection_site"})
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
