<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\MigrationHelper;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190820095033 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Populating articles without texts and translations';
    }

    public function up(Schema $schema) : void
    {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

		$articleIds = $this->connection->fetchAll("SELECT id FROM article ORDER BY title");
		$mh = new MigrationHelper();
		$this->addSql($mh->insert(
			'translations_article',
			['locale', 'object_class', 'field', 'foreign_key', 'content'],
			[
				[
					"'fr'",
					"'App\Entity\Article'",
					"'slug'",
					"'".$articleIds[0]['id']."'",
					"'implementer-traefik-dans-api-platform-sous-docker'",
				],
				[
					"'fr'",
					"'App\Entity\Article'",
					"'title'",
					"'".$articleIds[0]['id']."'",
					"'Implémenter Traefik dans API Platform sous Docker'",
				],
				[
					"'fr'",
					"'App\Entity\Article'",
					"'slug'",
					"'".$articleIds[1]['id']."'",
					"'du-rendu-côté-client-au-rendu-côté-serveur-en-utilisant-node-js'",
				],
				[
					"'fr'",
					"'App\Entity\Article'",
					"'title'",
					"'".$articleIds[1]['id']."'",
					"'Du rendu côté client au rendu côté serveur en utilisant Node.js'",
				],
			]
		));
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
