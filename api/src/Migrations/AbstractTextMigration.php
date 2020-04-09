<?php


namespace App\Migrations;


use Doctrine\Migrations\AbstractMigration;

abstract class AbstractTextMigration extends AbstractMigration {
	protected $article = null;

	protected function getTexts(): array
	{
		return [];
	}

	protected function insertTexts(int $n): void
	{
		$mh = new MigrationHelper();
		for ($i = 0; $i < $n; $i++) {
			$this->addSql(
				$mh->insert(
					'text',
					['article_id'],
					[
						[
							"'" . $this->article . "'",
						]
					],
					true
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
					],
					true
				)
			);
		}
	}
}
