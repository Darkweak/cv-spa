<?php


namespace App\Migrations;


use Doctrine\Migrations\AbstractMigration;

abstract class AbstractTranslatedTextMigration extends AbstractMigration
{
	protected $texts;
	protected $codePackages;

	protected function getTranslatedTextsFR(): array
	{
		return [];
	}

	protected function getTranslatedTextsEN(): array
	{
		return [];
	}

	protected function getCodes(): array
	{
		return [];
	}

	protected function insertTranslatedTexts(): void
	{
		$textsFR = $this->getTranslatedTextsFR();
		$textsEN = $this->getTranslatedTextsEN();
		$mh = new MigrationHelper();
		for ($i = 0; $i < count($this->texts); $i++) {
			$this->addSql(
				$mh->insert(
					'translations_text',
					[
						'description',
						'locale',
						'text_id',
					],
					[
						[
							"'".$textsFR[$i]."'",
							"'fr'",
							"'".$this->texts[$i]['id']."'",
						],
						[
							"'".$textsEN[$i]."'",
							"'en'",
							"'".$this->texts[$i]['id']."'",
						],
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
