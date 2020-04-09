<?php

namespace App\Traits;


use DateTime;
use Gedmo\Mapping\Annotation as Gedmo;

trait TimestampableTrait
{
	/**
	 * @var DateTime $created_at
	 *
	 * @Gedmo\Timestampable(on="create")
	 * @ORM\Column(type="datetime")
	 */
	private $created_at;

	public function getCreated(): DateTime
	{
		return $this->created_at;
	}
}
