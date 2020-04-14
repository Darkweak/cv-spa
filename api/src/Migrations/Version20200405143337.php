<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\MigrationHelper;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200405143337 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Insert containous, Wild code school and Open-source talks conferences';
    }

    public function up(Schema $schema) : void
    {
		$this->addSql(
			(new MigrationHelper())
				->insert(
					'conference',
					['abstract', 'street', 'date', 'image', 'link', 'name', 'city', 'cp'],
					[
						["'Nombreux sont ceux qui utilisent react-redux et recompose. Nombreux sont ceux qui font encore des classes composants.

Après de nombreux mois passés sur ReactJS, le composant de classe s''est vu être remplacé par le composant fonctionnel, notamment grâce à la librairie recompose. Puis depuis récemment, redux se voit peu à peu remplacé par l''ApiContext natif à ReactJS. Enfin, la plus grande révolution dans ReactJS fût l''introduction des hooks dirigé par Dan Abramov. Suite à cette introduction, ReactJS a connu une montée de hype autour de cette nouvelle philosophie et a su attirer de jeunes développeurs.

Durant ce talk Sylvain vous fera part d''un retour d''expérience sur cette transition en arborant aussi les problématiques rencontrées tant au niveau CSR (client-side rendering) mais aussi au niveau SSR (server-side rendering). De plus, pour la problématique du SSR, nous ne devions pas utiliser NextJS, et nous avons produit un résultat plus que satisfaisant car les performances étaient équivalentes, voire meilleures dans certains cas.

Le passage du lifecycle component aux hooks, de redux à l''ApiContext, de classe à composants, de l''ennui au plaisir. Plongeons dans le nouvel univers de ReactJS.'", "'Wild code school Lille'", "'2020-01-27'", "'/conferences/lille-27-01-2020.jpg'", "'https://www.meetup.com/fr-FR/Lille-Tech-Meetups/events/267991922'", "'ReactJs, bien débuter '", "'Lille'", "'59000'"],

						["'It''s been a few years since Les Tilleuls Coop developed monolithic applications. They, and developers around the world, now prefer to use microservices to reduce the risk involved with new code, so they''re able to change as little as possible, and not break the application core. To deploy and iterate as fast as possible, they use many different platforms, but with the power of Docker Swarm orchestration, and Traefik service management, they are able to do this all easily. In this session, Sylvain will share a first single project using Traefik and a few services. Then he''ll show multiple projects using a single instance of Traefik, and demo how to scale containers.'", "'Online meetup'", "'2019-10-24'", "'/conferences/traefik-24-10-2019.jpg'", "'https://zoom.us/webinar/register/WN_LWPxCkeRT4qAsVUbkW_s-Q'", "'Moving to Microservice Architecture Using Traefik, for Fast and Low Risk Deployment and Iteration '", "'Lyon'", "'69006'"],

						["'À l''ère des conteneurs en développement et surtout en production, il devient intéressant de les gérer avec un reverse-proxy, de déployer de nouvelles instances à la volée, ainsi que d''en supprimer et surtout les sécuriser.
Nous verrons comment déployer de nouveaux services et rajouter des instances déjà déployés afin d''accroître la tenue de charge du serveur à chaud, sans redémarrage du reverse-proxy.
Nous aborderons aussi la sécurité de l''application en mettant en place un fail2ban branché sur Traefik et sur nos conteneurs afin de bloquer les potentiels hackers.
Enfin nous voulons pouvoir déployer l''application très rapidement sous différents systèmes d''exploitation pour gérer tout cela.'", "'EPSI Montpellier - Croix Verte'", "'2020-02-04'", "'/conferences/montpellier-04-02-2020.jpg'", "'https://www.meetup.com/fr-FR/Open-Source_Talks/events/268109169/'", "'Træfik : la routourne a tourné pour Apache & Nginx'", "'Montpellier'", "'34000'"]
					],
					true
				)
		);
    }

    public function down(Schema $schema) : void
    {
    	$this->addSql("DELETE FROM conference WHERE date IN ('2020-01-27', '2020-02-04', '2019-10-24')");

    }
}
