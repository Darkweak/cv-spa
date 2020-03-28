<?php

namespace App\Entity;

use App\Traits\CityTrait;
use App\Traits\IdTrait;
use App\Traits\NameTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobRepository")
 */
class Job
{
	use IdTrait;
	use NameTrait;
	use CityTrait;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank
     */
    private $isValid;

    /**
     * @ORM\Column(type="date")
     */
    private $startedAt;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $leavedAt;

    /**
     * @ORM\Column
     * @Assert\NotBlank
     */
    private $institute;

    /**
     * @ORM\Column
     * @Assert\NotBlank
     */
    private $referent;

    public function getIsValid(): bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): self
    {
        $this->isValid = $isValid;
        return $this;
    }

    public function getStartedAt(): \DateTime
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTime $startedAt): self
    {
        $this->startedAt = $startedAt;
        return $this;
    }

    public function getLeavedAt(): ?\DateTime
    {
        return $this->leavedAt;
    }

    public function setLeavedAt(?\DateTime$leavedAt): self
    {
        $this->leavedAt = $leavedAt;
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

    public function getReferent(): string
    {
        return $this->referent;
    }

    public function setReferent(string $referent): self
    {
        $this->referent = $referent;
        return $this;
    }
}
