<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Traits\IdTrait;
use App\Traits\NameTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Category
{
	use IdTrait;
	use NameTrait;

    /**
     * @ORM\OneToMany(targetEntity="Competence", mappedBy="category")
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
