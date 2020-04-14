<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Traits\CityTrait;
use App\Traits\IdTrait;
use App\Traits\NameTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     	attributes={"order"={"startedAt": "DESC", "leavedAt": "DESC"}},
 *     	collectionOperations={
 *     		"get"={
 *     			"normalization_context"={"groups"={"job_list"}},
 *     			"security"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"
 *	 		},
 *     		"post"
 *	 	},
 *     	itemOperations={
 *     		"get",
 *     		"patch",
 *     		"delete"
 *	 	},
 *    	normalizationContext={"groups"={"job_list"}},
 *     	security="is_granted('ROLE_ADMIN')"
 * )
 * @ORM\Entity
 */
class Job
{
	use IdTrait;
	use NameTrait;
	use CityTrait;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank
	 * @Groups({"job_list"})
     */
    private $isValid;

    /**
     * @ORM\Column(type="date")
	 * @Groups({"job_list"})
     */
    private $startedAt;

    /**
     * @ORM\Column(type="date", nullable=true)
	 * @Groups({"job_list"})
     */
    private $leavedAt;

    /**
     * @ORM\Column
     * @Assert\NotBlank
	 * @Groups({"job_list"})
     */
    private $institute;

    /**
     * @ORM\Column
     * @Assert\NotBlank
	 * @Groups({"job_list"})
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
