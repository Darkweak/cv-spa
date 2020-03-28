<?php

namespace App\Entity;

use App\Traits\CityTrait;
use App\Traits\IdTrait;
use App\Traits\NameTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiplomaRepository")
 */
class Diploma
{
	use IdTrait;
	use NameTrait;
	use CityTrait;

    /**
     * @ORM\Column(type="date")
     */
    private $startedAt;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $obtainedAt;

    /**
     * @ORM\Column
     * @Assert\NotBlank
     */
    private $institute;

    /**
     * @ORM\Column
     * @Assert\NotBlank
     */
    private $linkCity;

    public function getStartedAt(): \DateTime
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTime $startedAt): self
    {
        $this->startedAt = $startedAt;
        return $this;
    }

    public function getObtainedAt(): ?\DateTime
    {
        return $this->obtainedAt;
    }

    public function setObtainedAt(?\DateTime$obtainedAt): self
    {
        $this->obtainedAt = $obtainedAt;
        return $this;
    }

    public function getInstitute(): string
    {
        return $this->institute;
    }

    public function setInstitute(string $institute): self
    {
        $this->institute = $institute;
        return $this;
    }

    public function getLintCity(): string
    {
        return $this->lintCity;
    }

    public function setLintCity(string $lintCity): self
    {
        $this->lintCity = $lintCity;
        return $this;
    }
}
