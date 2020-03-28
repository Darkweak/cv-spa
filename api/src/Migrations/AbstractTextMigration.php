<?php


namespace App\Migrations;


use Doctrine\Migrations\AbstractMigration;

abstract class AbstractTextMigration extends AbstractMigration {
	protected $article = null;

	protected function getTexts(): array
	{
		return [];
	}

	protected function insertTexts(): void
	{
		$texts = $this->getTexts();
		$mh = new MigrationHelper();
		for ($i = 0; $i < count($texts); $i++) {
			$this->addSql(
				$mh->insert(
					'text',
					['article_id', 'content'],
					[
						[
							"'" . $this->article . "'",
							"'" . $texts[$i] . "'"
						]
					]
				)
			);
		}
	}

	protected function insertCodePackages(int $loop): void
	{
		$mh = new MigrationHelper();
		for ($i = 0; $i < $loop; $i++) {
			$this->addSql(
				$mh->insert(
					'code_package',
					['article_id'],
					[
						["'" . $this->article . "'"]
					]
				)
			);
		}
	}
}
