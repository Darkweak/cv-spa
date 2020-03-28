<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\AbstractTranslatedTextMigration;
use Doctrine\DBAL\Schema\Schema;

final class Version20190820122502 extends AbstractTranslatedTextMigration
{
    public function getDescription() : string
    {
        return 'Populating translations and texts articles';
    }

    protected function getTranslatedTexts(): array
	{
		return [
			<<<HTML
<h2 id="implémentation-basique">Implémentation basique</h2>
                <p><a href="https://traefik.io" target="_blank" rel="nofollow noopener noreferrer">Traefik</a> est un reverse proxy / load balancer facile à prendre en main, dynamique, automatique, rapide complet, open source, prévu pour la production, apporte nativement des métriques de monitoring et s''intègre parfaitement avec la majorité des clusters.</p>
                <p>Cet outil vous permettra de définir vos propres routes pour votre partie client, api et plus généralement vos conteneurs.</p>
                <p>Utilisez ce <code>docker-compose.yml</code> prêt à l''emploi qui intègre toute la configuration nécessaire pour Traefik.<br>
                    Supprimez le mapping de ports des conteneurs, indiquez à Traefik les ports qu''il doit écouter et ajoutez les labels pour indiquer à Traefik d''écouter les routes mentionnée et rediriger les dites routes vers les conteneurs adéquats.</p>
                <p>
                    <code>--api</code> Indique à Traefik de générer un vue pour regarder les conteneurs et les IP/DNS associés<br>
                    <code>--docker</code> Indique à Traefik d''écouter l''APIde Docker<br>
                    <code>labels:</code> Clé pour la configuration des routes de Traefik
                </p>
HTML
			,
			<<<HTML
<p>
                    Le DNS de l''API sera spécifié avec
                    <code>traefik.frontend.rule=Host:your.host</code>
                    (ici api.localhost)
                </p>
                <p>
                    <code>--traefik.port=3000</code>
                    Le port spécifié à Traefik devra être exposé par le conteneur (ici l''application React expose le port 3000)
                </p>
HTML
			,
			<<<HTML
<p>N''oubliez pas la clé db-bata sinon la base de données ne fonctionnera pas avec cette solution conteneurisée.</p>
                <p><code>localhost</code> est un domaine réservé sur votre machine spécifiée dans votre <code>/etc/hosts</code>.
                    Si vous voulez ajouter des DNS personnalisé comme par exemple les DNS de production pour avoir les mêmes URL que sur cette dernière, il suffit de les ajouter à la fin de votre <code>/etc/host</code> comme ceci: </p>
HTML
			,
			<<<HTML
<p>Si vous faites cela vous devrez mettre à jour la variable d''environnement <code>CORS_ALLOW_ORIGIN</code>
                    dans <code>api/.env</code> pour accpeter l''URL spécifiée.</p>
                <h2 id="problématiques-connues">Problématiques connues</h2>
                <p>Si votre réseau est de type B cela peut créer des conflits avec les sous-réseaux de Docker et Traefik.</p>
                <h2 id="aller-plus-loin">Aller plus loin</h2>
                <p>Comme cette configuration de Traefik écoute sur les ports 80 et 443 vous ne pouvez lancer qu''une seule instance de Traefik par serveur. Cependant, vous voulez sûrement lancer plusieurs instances d''APIPlatform sur le même serveur. Pour se faire,
                    vous devez externaliser la configuration de Traefik vers un autre <code>docker-compose.yml</code> quelque part sur votre serveur.
                    Voici un exemple fonctionnel: </p>
HTML
			,
			<<<HTML
<p>Puis mettez à jour votre fichier <code>docker-compose.yaml</code> situé dans votre projet API Platform: </p>
HTML
			,
			<<<HTML
<p>Enfin, les variables d''environnements doivent être définies, voici un exemple du fichier <code>.env</code> pour toutes les définir: </p>
HTML
			,
			<<<HTML
<p>De cette façon vous pourrez configurer vos variables dans un seul fichier.</p>
HTML
		];
	}

	protected function getCodes(): array
	{
		return [
			[
				"name" => "yaml",
				"content" => <<<'EOT'
services:
#  ...
  api:
    labels: 
      - traefik.frontend.rule=Host:api.localhost
EOT
			],
			[
				"name" => "yaml",
				"content" => <<<'EOT'
# docker-compose.yml
version: ''3.4''

x-cache:
  &cache
  cache_from:
    - ${CONTAINER_REGISTRY_BASE}/php
    - ${CONTAINER_REGISTRY_BASE}/nginx
    - ${CONTAINER_REGISTRY_BASE}/varnish


services:
  traefik:
    image: traefik
    command: --api --docker
    ports:
      - "80:80" #All HTTP access will be caught by Traefik
      - "443:443" #All HTTPS access will be caught by Traefik
      - "8080:8080" #Access Traefik webview
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock

  php:
    image: ${CONTAINER_REGISTRY_BASE}/php
    build:
      context: ./api
      target: api_platform_php
      <<: *cache
    depends_on:
      - db
    # Comment out these volumes in production
    volumes:
      - ./api:/srv/api:rw,cached
      # If you develop on Linux, uncomment the following line to use a bind-mounted host directory instead
      # - ./api/var:/srv/api/var:rw

  api:
    image: ${CONTAINER_REGISTRY_BASE}/nginx
    labels:
      - traefik.frontend.rule=Host:api.localhost
    build:
      context: ./api
      target: api_platform_nginx
      <<: *cache
    depends_on:
      - php
    # Comment out this volume in production
    volumes:
      - ./api/public:/srv/api/public:ro

  cache-proxy:
    image: ${CONTAINER_REGISTRY_BASE}/varnish
    build:
      context: ./api
      target: api_platform_varnish
      <<: *cache
    depends_on:
      - api
    volumes:
      - ./api/docker/varnish/conf:/usr/local/etc/varnish:ro
    tmpfs:
      - /usr/local/var/varnish:exec
    labels:
      - traefik.frontend.rule=Host:cache.localhost

  db:
    # In production, you may want to use a managed database service
    image: postgres:10-alpine
    labels:
      - traefik.frontend.rule=Host:db.localhost
    environment:
      - POSTGRES_DB=api
      - POSTGRES_USER=api-platform
      # You should definitely change the password in production
      - POSTGRES_PASSWORD=!ChangeMe!
    volumes:
      - db-data:/var/lib/postgresql/data:rw
      # You may use a bind-mounted host directory instead, so that it is harder to accidentally remove the volume and lose all your data!
      # - ./docker/db/data:/var/lib/postgresql/data:rw
    ports:
      - "5432:5432"

  mercure:
    # In production, you may want to use the managed version of Mercure, https://mercure.rocks
    image: dunglas/mercure
    environment:
      # You should definitely change all these values in production
      - JWT_KEY=!UnsecureChangeMe!
      - ALLOW_ANONYMOUS=1
      - CORS_ALLOWED_ORIGINS=*
      - PUBLISH_ALLOWED_ORIGINS=http://mercure.localhost
      - DEMO=1
    labels:
      - traefik.frontend.rule=Host:localhost

  client:
    # Use a static website hosting service in production
    # See https://github.com/facebookincubator/create-react-app/blob/master/packages/react-scripts/template/README.mddeployment
    image: ${CONTAINER_REGISTRY_BASE}/client
    build:
      context: ./client
      cache_from:
        - ${CONTAINER_REGISTRY_BASE}/client
    env_file:
      - ./client/.env
    volumes:
      - ./client:/usr/src/client:rw,cached
      - /usr/src/client/node_modules
    expose:
      - 3000
    labels:
      - traefik.port=3000
      - traefik.frontend.rule=Host:localhost

  admin:
    # Use a static website hosting service in production
    # See https://facebook.github.io/create-react-app/docs/deployment
    image: ${CONTAINER_REGISTRY_BASE}/admin
    build:
      context: ./admin
      cache_from:
        - ${CONTAINER_REGISTRY_BASE}/admin
    volumes:
      - ./admin:/usr/src/admin:rw,cached
      - /usr/src/admin/node_modules
    expose:
      - 3000
    labels:
      - traefik.port=3000
      - traefik.frontend.rule=Host:admin.localhost

volumes:
  db-data: {}
EOT
			],
			[
				"name" => "bash",
				"content" => <<<'EOT'
# /etc/hosts
# ...

127.0.0.1       your.domain.com
EOT
			],
			[
				"name" => "yaml",
				"content" => <<<'EOT'
# /somewhere/docker-compose.yml
version: ''3.4''

services:
  traefik:
    image: traefik
    command: --api --docker
    ports:
      - "80:80"
      - "443:443"
      - "8080:8080"
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock
# load a TOML configuration file and to generate Let''s Encrypt certificated as explained in https://docs.traefik.io/user-guide/docker-and-lets-encrypt/
#      - ./traefik.toml:/traefik.toml
#      - ./acme.json:/acme.json
    networks:
      - api_platform_network
    # Add other networks here

networks:
  api_platform_network:
    external: true
  # Add other networks here
EOT
			],
			[
				"name" => "yaml",
				"content" => <<<'EOT'
# docker-compose.yml
version: ''3.4''

x-cache:
  &cache
  cache_from:
    - ${CONTAINER_REGISTRY_BASE}/php
    - ${CONTAINER_REGISTRY_BASE}/nginx
    - ${CONTAINER_REGISTRY_BASE}/varnish

+x-network:
+  &network
+  networks:
+    - api_platform_network

services:
# Uncomment these lines only if you want to run one api-platform instance using traefik
-  traefik:
-    image: traefik:latest
-    command: --api --docker
-    ports:
-      - "80:80"
-      - "443:443"
-    volumes:
-      - /var/run/docker.sock:/var/run/docker.sock
-    <<: *network

  php:
    image: ${CONTAINER_REGISTRY_BASE}/php
    build:
      context: ./api
      target: api_platform_php
      <<: *cache
    depends_on: 
      - db
+    environment:
+      # You should remove these variables from .env into api folder
+      - TRUSTED_HOSTS=^(((${SUBDOMAINS_LIST}\.)?${DOMAIN_NAME})|api)$$
+      - CORS_ALLOW_ORIGIN=^${HTTP_OR_SSL}(${SUBDOMAINS_LIST}.)?${DOMAIN_NAME}$$
+      - DATABASE_URL=postgres://${DB_USER}:${DB_PASS}@db/${DB_NAME}
+      - MERCURE_SUBSCRIBE_URL=${HTTP_OR_SSL}mercure.${DOMAIN_NAME}$$
+      - MERCURE_PUBLISH_URL=${HTTP_OR_SSL}mercure.${DOMAIN_NAME}$$
+      - MERCURE_JWT_SECRET=${JWT_KEY}
    volumes:
      - ./api:/srv/api:rw,cached
+    <<: *network

  api:
    image: ${CONTAINER_REGISTRY_BASE}/nginx
    build:
      context: ./api
      target: api_platform_nginx
      <<: *cache
    depends_on:
      - php
    volumes:
      - ./api/public:/srv/api/public:ro
    labels:
      - traefik.frontend.rule=Host:api.${DOMAIN_NAME}
+    <<: *network

  cache-proxy:
    image: ${CONTAINER_REGISTRY_BASE}/varnish
    build:
      context: ./api
      target: api_platform_varnish
      <<: *cache
    depends_on:
      - api
    volumes:
      - ./api/docker/varnish/conf:/usr/local/etc/varnish:ro
    tmpfs:
      - /usr/local/var/varnish:exec
    labels:
      - traefik.frontend.rule=Host:cache.${DOMAIN_NAME}
+    <<: *network

  db:
    image: postgres:10-alpine
    environment:
      - POSTGRES_DB=${DB_NAME}
      - POSTGRES_USER=${DB_USER}
      - POSTGRES_PASSWORD=${DB_PASS}
    volumes:
      - db-data:/var/lib/postgresql/data:rw
+    <<: *network

  mercure:
    image: dunglas/mercure
    environment:
      - JWT_KEY=${JWT_KEY}
      - ALLOW_ANONYMOUS=0
      - CORS_ALLOWED_ORIGINS=^${HTTP_OR_SSL}(${SUBDOMAINS_LIST}.)?${DOMAIN_NAME}$$
      - PUBLISH_ALLOWED_ORIGINS=${HTTP_OR_SSL}
      - DEMO=1
    labels:
      - traefik.frontend.rule=Host:mercure.${DOMAIN_NAME}
+    <<: *network

  client:
    image: ${CONTAINER_REGISTRY_BASE}/client
    build:
      context: ./client
      cache_from:
        - ${CONTAINER_REGISTRY_BASE}/client
    volumes:
      - ./client:/usr/src/client:rw,cached
      - /usr/src/client/node_modules
    expose:
      - 3000
    labels:
      - traefik.frontend.rule=Host:${DOMAIN_NAME},www.${DOMAIN_NAME}
      - traefik.port=3000
    environment:
      # You should remove this variable from .env into client folder
      - REACT_APP_API_ENTRYPOINT=${HTTP_OR_SSL}api.${DOMAIN_NAME}
+    <<: *network

  admin:
    image: ${CONTAINER_REGISTRY_BASE}/admin
    build:
      context: ./admin
      cache_from:
        - ${CONTAINER_REGISTRY_BASE}/admin
    environment:
      # You should remove this variable from .env into admin folder
      - REACT_APP_API_ENTRYPOINT=${HTTP_OR_SSL}api.${DOMAIN_NAME}
    volumes:
      - ./admin:/usr/src/admin:rw,cached
      - /usr/src/admin/node_modules
    expose:
      - 3000
    labels:
      - traefik.frontend.rule=Host:admin.${DOMAIN_NAME}
      - traefik.port=3000
+    <<: *network

volumes:
  db-data: {}

+networks:
+  api_platform_network:
+    external: true
EOT
			],
			[
				"name" => "bash",
				"content" => <<<'EOT'
CONTAINER_REGISTRY_BASE=quay.io/api-platform
DOMAIN_NAME=localhost
HTTP_OR_SSL=http://
DB_NAME=api-platform-db-name
DB_PASS=YouMustChangeThisPassword
DB_USER=api-platform
JWT_KEY=!UnsecureChangeMe!
SUBDOMAINS_LIST=(admin|api|cache|mercure|www)
EOT
			]
		];
	}

    public function up(Schema $schema) : void
    {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

		$article = $this->connection->fetchAll("SELECT id FROM article")[0]['id'];
		$this->text = $this->connection->fetchAll("SELECT id FROM text WHERE article_id = '$article'");
		$this->codePackages = $this->connection->fetchAll("SELECT id FROM code_package WHERE article_id = '$article'");
		$this->insertTranslatedTexts();
		$this->insertCodes();
	}

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

		$this->addSql(<<<SQL
DELETE FROM translations_text WHERE 1;
SQL
		);
		$this->addSql(<<<SQL
DELETE FROM code WHERE 1;
SQL
);
    }
}
