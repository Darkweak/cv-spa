<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\MigrationHelper;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190801201149 extends AbstractMigration
{
	public function getDescription(): string
	{
		return 'Database populating';
	}

	public function up(Schema $schema): void
	{
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

		$this->addSql(
			(new MigrationHelper())
				->insert(
					'category',
					['name'],
					[
						["'Web'"],
						["'Bureautique'"],
						["'Application'"],
						["'Base de données'"],
						["'Framework'"],
						["'Systèmes d''exploitation'"],
						["'Outils'"]
					]
				)
		);
		$this->addSql(
			(new MigrationHelper())
				->insert(
					'diploma',
					['name', 'started_at', 'obtained_at', 'city', 'institute', 'cp', 'link_city'],
					[
						["'BREVET'", "'2008-09-01'", "'2012-07-01'", "'VOUZIERS'", "'COLLÈGE SAINT-LOUIS'", "'08400'", "'https://www.ville-vouziers.fr/'"],
						["'BAC S'", "'2012-09-03'", "'2015-07-01'", "'VOUZIERS'", "'LYCÉE THOMAS MASARYK'", "'08400'", "'https://www.ville-vouziers.fr/'"],
						["'DUT INFORMATIQUE'", "'2015-09-03'", "'2018-07-04'", "'REIMS'", "'IUT REIMS'", "'51100'", "'https://www.reims.fr/'"]
					]
				)
		);
		$this->addSql(
			(new MigrationHelper())
				->insert(
					'job',
					['name', 'is_valid', 'started_at', 'leaved_at', 'city', 'institute', 'cp', 'referent'],
					[
						["'ANIMATEUR BÉNÉVOLE EN CENTRE AÉRÉ'", "true", "'2016-07-04'", "'2016-07-22'", "'SAINT-ETIENNE-À-ARNES'", "'Centre aéré'", "'08310'", "'Mme. Audrey LOUIS'"],
						["'BOUCHER EN GRANDE DISTRIBUTION'", "true", "'2017-06-26'", "'2017-08-05'", "'VOUZIERS'", "'E.Leclerc'", "'08400'", "'M. Emmanuel LEPLANG'"],
						["'AUXILIAIRE DE VACANCES ET TECHNICIEN DE MAINTENANCE EN MILIEU BANCAIRE'", "true", "'2017-08-07'", "'2017-09-01'", "'REIMS'", "'Société générale'", "'51100'", "'Mme. Lydie GUILLIER'"],
						["'DÉVELOPPEUR FULL-STACK'", "'t'", "'2018-07-02'", "null", "'LILLE'", "'Les-tilleuls.coop'", "'59000'", "'M. Olivier LENANCKER'"],
						["'DÉVELOPPEUR FREELANCE'", "'t'", "'2019-02-10'", "null", "'LILLE'", "'Auto-entreprise'", "'59000'", "'M. Sylvain COMBRAQUE'"]
					]
				)
		);
		$this->addSql(
			(new MigrationHelper())
				->insert(
					'site',
					['name', 'link', 'image', 'description'],
					[
						["'cieldrones'", "'https://cieldrones.fr'", "'/creations/cieldrones.png'", "'Site vitrine pour promouvoir l''audit de terrain et la prise de photos par des drones'"],
						["'cv'", "'https://devcv.fr'", "'/creations/devcv.png'", "'Mon cv en ligne pour montrer au monde entier mes créations, mes compétences ainsi que mon parcours. Vous pouvez me contacter directement dessus'"],
						["'marketplace'", "'https://marketplace.devcv.fr'", "'/creations/marketplace.png'", "'Réalisation du template pour un site de vente en ligne. Gestion des promos, des paniers, mise en place de diverses sécurités. Cela permet de proposer des sites e-commerce à un prix imbatable sans avoir à refaire la logique et la sécurité du site'"],
						["'mandatstore'", "'https://mandatstore.com'", "'/creations/mandatstore.png'", "'Site de vente de mandats immobiliers en ligne. Utilisation de Stripe pour le paiement ainsi que mailgun pour l''envoie d''emails'"]
					]
				)
		);
		$this->addSql(
			(new MigrationHelper())
				->insert(
					'tag',
					['name'],
					[
						["'API Platform'"],
						["'Bootstrap'"],
						["'CSS'"],
						["'Docker'"],
						["'HTML'"],
						["'NodeJS'"],
						["'PHP'"],
						["'ReactJS'"],
						["'Semantic UI'"],
						["'SSR'"],
						["'Symfony'"],
						["'Traefik'"],
						["'Twig'"],
					]
				)
		);
		$this->addSql(
			(new MigrationHelper())
				->insert(
					'conference',
					['abstract', 'street', 'date', 'image', 'link', 'name', 'city', 'cp'],
					[
						["'Avant, déployer une application était d’une simplicité extrême. On la développait, on la mettait sur notre serveur et on faisait son fichier de configuration pour apache/nginx. Ces deux solutions convenaient très bien aux applications monolithiques. Cependant, depuis quelques années nous ne développons plus ces applications monolithiques mais nous préférons les découper en plusieurs services afin de pouvoir déployer chaque service indépendamment les uns des autres et possiblement ne pas casser le core de l’application. Nous voulons aussi scale horizontalement et verticalement notre application et cela à chaud. Apache et Nginx n''étant pas capables de le faire, nous allons voir comment gérer ce problème avec un outil open-source (Traefik) et le mettre en application avec le framework API-Platform'", "'IUT Reims'", "'2018-12-20'", "'/conferences/reims-20-12-2018.png'", "'https://www.meetup.com/fr-FR/afup-reims-php/events/256643071/'", "'Gérez vos microservices avec Traefik'", "'Reims'", "'51100'"],
						["'Avant, déployer une application était d’une simplicité extrême. On la développait, on la mettait sur notre serveur et on faisait son fichier de configuration pour apache/nginx. Ces deux solutions convenaient très bien aux applications monolithiques. Cependant, depuis quelques années nous ne développons plus ces applications monolithiques mais nous préférons les découper en plusieurs services afin de pouvoir déployer chaque service indépendamment les uns des autres et possiblement ne pas casser le core de l’application. Nous voulons aussi scale horizontalement et verticalement notre application et cela à chaud. Apache et Nginx n''étant pas capables de le faire, nous allons voir comment gérer ce problème avec un outil open-source (Traefik) et le mettre en application avec le framework API-Platform'", "'Auberge Stéphane Hessel'", "'2019-01-22'", "'/conferences/lille-22-01-2019.png'", "'https://www.meetup.com/fr-FR/afup-hauts-de-france-php/events/258090584/'", "'Gérez vos microservices avec Traefik'", "'Lille'", "'59000'"],
						["'Durant cette conférence, nous parlerons de divers trucs et astuces pour protéger ses applications rapidement, simplement et surtout à moindre frais.

Les attaques MITM (man in the middle), les injections sql, les bruteforces sur les formulaires de login, l''utilisation de webShell et tant d''autres attaques. Certaines de ces attaques ne vous disent peut-être rien, cependant elles sont toutes aussi dangereuses car elles permettent à un hacker de prendre la main totalement ou partiellement sur votre serveur et ainsi devenir l''administrateur de ce dernier.

Plusieurs possibilités s''offrent à nous :
- HTTPS
- Utiliser un ORM pour les requêtes dans la base de données
- Dockeriser l''application
- HTTP/2
- Mettre en place un firewall
- Automatiser les bannissements avec Fail2Ban
- Mercure

Ce sont des solutions tirées arbitrairement qui vous permettront de sécuriser votre application rapidement et facilement.'",	"'Seine Innopolis'", "'2019-07-30'", "'/conferences/rouen-30-07-2019.png'", "'https://www.meetup.com/fr-FR/codeursenseine/events/262892736/'", "'Comment empêcher Jean-Kévin du 62 de hacker votre application'", "'Rouen'", "'76000'"],
						["'Depuis quelques années nous ne développons plus des grosses applications monolithiques mais nous préférons les découper en plusieurs services afin de pouvoir déployer chaque service indépendamment les uns des autres et possiblement ne pas casser le coeur de l’application.

Nous voulons aussi déployer de nouveaux services et aussi rajouter des instances de services déjà déployés afin d''accroître la tenue de charge du serveur contenant notre application et cela à chaud, sans redémarrage du reverse-proxy. De plus nous aimerions avoir possiblement plusieurs applications totalement différentes, par exemple un serveur Teamspeak, un site web avec une API en PHP, un front en ReactJS, un petit serveur web en Go, et une instance d''un serveur web Tomcat.

Enfin nous voulons pouvoir déployer l''application très rapidement. Nous devrions avoir différents systèmes d''exploitation pour gérer tout cela, cependant grâce à Docker, à l''orchestration de Docker Swarm et la gestion des services grâce à Traefik nous allons le faire facilement'", "'Marriott Rive Gauche'", "'2019-10-25'", "'/conferences/paris-25-10-2019.png'", "'https://event.afup.org/forumphp2019/programme/#3022'", "'Gérez le Traefik de vos services'", "'Paris'", "'75014'"]
					],
					true
				)
		);
	}

	public function down(Schema $schema): void
	{
		$this->addSql('DELETE FROM conference WHERE 1 = 1');
		$this->addSql('DELETE FROM category WHERE 1 = 1');
		$this->addSql('DELETE FROM diploma WHERE 1 = 1');
		$this->addSql('DELETE FROM job WHERE 1 = 1');
		$this->addSql('DELETE FROM site WHERE 1 = 1');
		$this->addSql('DELETE FROM tag WHERE 1 = 1');
	}
}
