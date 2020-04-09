<?php

namespace App\Entity\Translation;

use App\Entity\Text;
use App\Traits\DescriptionTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="translations_text")
 * @ORM\Entity
 */
class TextTranslation extends AbstractTranslation
{
	use DescriptionTrait;

	/**
	 * @ORM\ManyToOne(targetEntity=Text::class, inversedBy="translations")
	 * @ORM\JoinColumn(name="text_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $translatable;
}
