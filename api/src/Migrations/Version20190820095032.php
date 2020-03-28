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
			['image', 'title', 'content', 'slug'],
			[
				[
					"'https://sylvaincdn.000webhostapp.com/devcv/traefik.png'",
					"'Implement Traefik Into API Platform Dockerized'",
					"''",
					"'implement-traefik-into-api-platform-dockerized'",
				],
				[
					"'https://sylvaincdn.000webhostapp.com/devcv/ssr.png'",
					"'From Client Side Rendered to Server Side Rendered applications using Node.js'",
					"''",
					"'from-client-side-rendered-to-server-side-rendered-applications-using-node-js'",
				],
			]
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
