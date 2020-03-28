<?php

namespace App\Entity\Translation;

use App\Repository\TextRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;

/**
 * @ORM\Table(name="translations_text", indexes={
 *      @ORM\Index(name="text_translation_idx", columns={"locale", "object_class", "field", "foreign_key"})
 * })
 * @ORM\Entity(repositoryClass=TextRepository::class)
 */
class TextTranslation extends AbstractTranslation
{}
