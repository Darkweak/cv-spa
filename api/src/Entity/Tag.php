<?php

namespace App\Entity;

use App\Traits\IdTrait;
use App\Traits\NameTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Tag
{
	use IdTrait;
	use NameTrait;
    /**
     * @ORM\ManyToMany(targetEntity=Site::class, mappedBy="tags")
     */
    private $sites;

    public function __construct()
    {
        $this->sites = new ArrayCollection();
    }

    public function getSites(): Collection
    {
        return $this->sites;
    }

    public function setSites(Collection $sites): self
    {
        $this->sites = $sites;
        return $this;
    }

    public function addSite(Site $site): self
    {
        if (!$this->sites->contains($site)) {
            $this->sites->add($site);
        }
        return $this;
    }

    public function removeSite(Site $site): self
    {
        $this->sites->remove($site);
        return $this;
    }
}
