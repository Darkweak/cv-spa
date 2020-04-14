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
 *     	attributes={"order"={"startedAt": "DESC", "obtainedAt": "DESC"}},
 *     	collectionOperations={
 *     		"get"={
 *     			"normalization_context"={"groups"={"diploma_list"}},
 *     			"security"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"
 *	 		},
 *     		"post"
 *	 	},
 *     	itemOperations={
 *     		"get",
 *     		"patch",
 *     		"delete"
 *	 	},
 *    	normalizationContext={"groups"={"diploma_list"}},
 *     	security="is_granted('ROLE_ADMIN')"
 * )
 * @ORM\Entity
 */
class Diploma
{
	use IdTrait;
	use NameTrait;
	use CityTrait;

    /**
     * @ORM\Column(type="date")
	 * @Groups({"diploma_list"})
     */
    private $startedAt;

    /**
     * @ORM\Column(type="date", nullable=true)
	 * @Groups({"diploma_list"})
     */
    private $obtainedAt;

    /**
     * @ORM\Column
     * @Assert\NotBlank
	 * @Groups({"diploma_list"})
     */
    private $institute;

    /**
     * @ORM\Column
     * @Assert\NotBlank
	 * @Groups({"diploma_list"})
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
