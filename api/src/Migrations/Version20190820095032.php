<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\MigrationHelper;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190820095032 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Populating articles without texts and translations';
    }

    public function up(Schema $schema) : void
    {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

		$mh = new MigrationHelper();
		$this->addSql($mh->insert(
			'article',
			['image'],
			[
				[
					"'https://sylvaincdn.000webhostapp.com/devcv/traefik.png'",
				],
				[
					"'https://sylvaincdn.000webhostapp.com/devcv/ssr.png'",
				],
			],
			true
		));
	}

    public function down(Schema $schema) : void
    {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

		$this->addSql(<<<SQL
DELETE FROM article WHERE 1
SQL
		);
	}
}
