<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\AbstractTextMigration;
use App\Migrations\MigrationHelper;
use Doctrine\DBAL\Schema\Schema;

final class Version20190820095033 extends AbstractTextMigration
{
    public function getDescription() : string
    {
        return 'Populating articles without texts and translations';
    }

    public function up(Schema $schema) : void
    {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

		$articleIds = $this->connection->fetchAll("SELECT id FROM article ORDER BY created_at");
		$mh = new MigrationHelper();
		$this->addSql($mh->insert(
			'translations_article',
			['article_id', 'locale', 'slug', 'title'],
			[
				[
					"'".$articleIds[0]['id']."'",
					"'fr'",
					"'implementer-traefik-dans-api-platform-sous-docker'",
					"'Implémenter Traefik dans API Platform sous Docker'",
				],
				[
					"'".$articleIds[0]['id']."'",
					"'en'",
					"'implement-traefik-into-api-platform-dockerized'",
					"'Implement Traefik Into API Platform Dockerized'",
				],
				[
					"'".$articleIds[1]['id']."'",
					"'fr'",
					"'du-rendu-côté-client-au-rendu-côté-serveur-en-utilisant-node-js'",
					"'Du rendu côté client au rendu côté serveur en utilisant Node.js'",
				],
				[
					"'".$articleIds[1]['id']."'",
					"'en'",
					"'from-client-side-rendered-to-server-side-rendered-applications-using-node-js'",
					"'From Client Side Rendered to Server Side Rendered applications using Node.js'",
				],
			]
		));
		$this->article = $articleIds[0]['id'];
		$this->insertTexts(7);
		$this->insertCodePackages(6);
	}

    public function down(Schema $schema) : void
    {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

		$this->addSql(<<<SQL
DELETE FROM translations_article WHERE 1
SQL
		);
	}
}
