<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\MigrationHelper;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190801201150 extends AbstractMigration
{
	private $tagIds = [];

	public function getDescription(): string
	{
		return 'Database populating';
	}

	private function getWebs(string $id): array
	{
		return [
			["'$id'", "'HTML'", "'https://www.w3schools.com/html/'"],
			["'$id'", "'CSS'", "'https://www.w3schools.com/css/'"],
			["'$id'", "'Javascript'", "'https://www.w3schools.com/js/'"],
			["'$id'", "'PHP'", "'http://php.net/'"],
			["'$id'", "'ASP'", "'https://fr.wikipedia.org/wiki/ASP.NET'"],
			["'$id'", "'Ruby on Rails'", "'http://rubyonrails.org/'"]
		];
	}

	private function getBureautiques(string $id): array
	{
		return [
			["'$id'", "'Word'", "'https://products.office.com/fr-fr/word'"],
			["'$id'", "'Excel'", "'https://products.office.com/fr-fr/excel'"],
			["'$id'", "'Powerpoint'", "'https://products.office.com/fr-fr/powerpoint'"]
		];
	}

	private function getApplications(string $id): array
	{
		return [
			["'$id'", "'Ruby'", "'https://www.ruby-lang.org/fr/'"],
			["'$id'", "'Java'", "'https://www.java.com/fr/'"],
			["'$id'", "'C#'", "'https://fr.wikipedia.org/wiki/C_sharp'"],
			["'$id'", "'Python'", "'https://www.python.org/'"]
		];
	}

	private function getDatabases(string $id): array
	{
		return [
			["'$id'", "'SQL'", "'https://www.w3schools.com/sql/'"],
			["'$id'", "'MySQL'", "'https://www.mysql.com/'"],
			["'$id'", "'Oracle'", "'https://www.oracle.com/'"],
			["'$id'", "'MariaDB'", "'https://mariadb.org/'"],
			["'$id'", "'SQLite'", "'https://www.sqlite.org/index.html'"],
			["'$id'", "'PostgreSQL'", "'https://www.postgresql.org'"],
			["'$id'", "'Mongo DB'", "'https://www.mongodb.com/fr'"],
			["'$id'", "'GraphQL'", "'https://graphql.org'"]
		];
	}

	private function getFrameworks(string $id): array
	{
		return [
			["'$id'", "'Bootstrap'", "'https://getbootstrap.com/'"],
			["'$id'", "'Materialize'", "'http://materializecss.com'"],
			["'$id'", "'CakePHP'", "'https://cakephp.org'"],
			["'$id'", "'Symfony'", "'https://symfony.com'"],
			["'$id'", "'Laravel'", "'https://laravel.com'"],
			["'$id'", "'.NET'", "'https://www.microsoft.com/net/'"],
			["'$id'", "'JQuery'", "'https://jquery.com'"],
			["'$id'", "'Cordova'", "'https://cordova.apache.org'"],
			["'$id'", "'Ionic'", "'https://ionicframework.com'"],
			["'$id'", "'ReactNative'", "'https://facebook.github.io/react-native'"],
			["'$id'", "'Electron'", "'https://electronjs.org'"],
			["'$id'", "'API Platform'", "'https://api-platform.com'"],
			["'$id'", "'Material UI'", "'https://material-ui.com'"],
			["'$id'", "'Ant Design'", "'https://ant.design'"],
			["'$id'", "'Semantic UI'", "'https://semantic-ui.com'"],
			["'$id'", "'ReactJS'", "'https://reactjs.org'"],
			["'$id'", "'Vuejs'", "'https://vuejs.org'"]
		];
	}

	private function getOS(string $id): array
	{
		return [
			["'$id'", "'Debian'", "'https://www.debian.org/index.fr.html'"],
			["'$id'", "'Kali'", "'https://www.kali.org'"],
			["'$id'", "'Ubuntu'", "'https://www.ubuntu.com'"],
			["'$id'", "'Fedora'", "'https://getfedora.org/fr'"],
			["'$id'", "'Windows'", "'https://www.microsoft.com/fr-fr/windows/'"],
			["'$id'", "'MacOS'", "'https://www.apple.com/fr/macos'"],
			["'$id'", "'Android'", "'https://developer.android.com'"],
			["'$id'", "'iOS'", "'https://www.apple.com/ios'"]
		];
	}

	private function getTools(string $id): array
	{
		return [
			["'$id'", "'Git'", "'https://fr.wikipedia.org/wiki/Git'"],
			["'$id'", "'GitHub'", "'https://github.com'"],
			["'$id'", "'Gitlab'", "'https://gitlab.com'"],
			["'$id'", "'Docker'", "'https://www.docker.com'"],
			["'$id'", "'Circle CI'", "'https://circleci.com'"],
			["'$id'", "'Travis'", "'https://travis-ci.org'"],
			["'$id'", "'IntelliJ'", "'https://www.jetbrains.com/idea'"],
			["'$id'", "'GitKraken'", "'https://www.gitkraken.com'"]
		];
	}

	public function getCieldronesTags(string $id): array
	{
		return (new MigrationHelper($id, $this->tagIds))->getTags([0, 1, 2, 3, 4, 6, 7, 10, 11]);
	}

	public function getCvTags(string $id): array
	{
		return (new MigrationHelper($id, $this->tagIds))->getTags([0, 1, 2, 3, 4, 5, 6, 7, 9, 10, 11]);
	}

	public function getMandatstoreTags(string $id): array
	{
		return (new MigrationHelper($id, $this->tagIds))->getTags([1, 2, 3, 4, 6, 10, 11, 12]);
	}

	public function getMarketplaceTags(string $id): array
	{
		return (new MigrationHelper($id, $this->tagIds))->getTags([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]);
	}

	public function up(Schema $schema): void
	{
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
		$categoryIds = $this->connection->fetchAll("SELECT id FROM category ORDER BY name");
		$siteIds = $this->connection->fetchAll("SELECT id FROM site ORDER BY name");
		$this->tagIds = $this->connection->fetchAll("SELECT id FROM tag ORDER BY name");

		$categories = [
			$this->getWebs($categoryIds[6]['id']),
			$this->getBureautiques($categoryIds[2]['id']),
			$this->getApplications($categoryIds[0]['id']),
			$this->getDatabases($categoryIds[1]['id']),
			$this->getFrameworks($categoryIds[3]['id']),
			$this->getOS($categoryIds[5]['id']),
			$this->getTools($categoryIds[4]['id'])
		];
		$sites = [
			$this->getCieldronesTags($siteIds[0]['id']),
			$this->getCvTags($siteIds[1]['id']),
			$this->getMandatstoreTags($siteIds[2]['id']),
			$this->getMarketplaceTags($siteIds[3]['id']),
		];

		foreach ($categories as $category) {
			$this->addSql(
				(new MigrationHelper())
					->insert(
						'competence',
						['category_id', 'name', 'link'],
						$category
					)
			);
		}

		foreach ($sites as $site) {
			$this->addSql(
				(new MigrationHelper())
					->insert(
						'site_tag',
						['site_id', 'tag_id'],
						$site,
						true
					)
			);
		}
	}

	public function down(Schema $schema): void
	{
		$this->addSql('DELETE FROM competence WHERE 1 = 1');
		$this->addSql('DELETE FROM site_tag WHERE 1 = 1');
	}
}
