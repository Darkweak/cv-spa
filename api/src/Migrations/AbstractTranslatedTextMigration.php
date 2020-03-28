<?php


namespace App\Migrations;


use Doctrine\Migrations\AbstractMigration;

abstract class AbstractTranslatedTextMigration extends AbstractMigration
{
	protected $text;
	protected $codePackages;

	protected function getTranslatedTexts(): array
	{
		return [];
	}

	protected function getCodes(): array
	{
		return [];
	}

	protected function insertTranslatedTexts(): void
	{
		$texts = $this->getTranslatedTexts();
		$mh = new MigrationHelper();
		for ($i = 0; $i < count($texts); $i++) {
			$this->addSql(
				$mh->insert(
					'translations_text',
					[
						'locale',
						'object_class',
						'field',
						'foreign_key',
						'content'
					],
					[
						[
							"'fr'",
							"'App\Entity\Text'",
							"'content'",
							"'".$this->text[$i]['id']."'",
							"'".$texts[$i]."'"
						]
					]
				)
			);
		}
	}

	protected function insertCodes(): void
	{
		$codes = $this->getCodes();
		$mh = new MigrationHelper();
		for ($i = 0; $i < count($codes); $i++) {
			$code = $codes[$i];
			$name = $code['name'];
			$content = $code['content'];
			$this->addSql(
				$mh->insert(
					'code',
					['code_package_id', 'name', 'content'],
					[
						["'".$this->codePackages[$i]['id']."'", "'$name'", "'$content'"]
					]
				)
			);
		}
	}
}
