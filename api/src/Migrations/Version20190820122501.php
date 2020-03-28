<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\AbstractTextMigration;
use Doctrine\DBAL\Schema\Schema;

final class Version20190820122501 extends AbstractTextMigration
{
	public function getDescription(): string
	{
		return 'Populating translations and texts articles';
	}

	protected function getTexts(): array
	{
		return [
			<<<HTML
<h2 id="basic-implementation">Basic Implementation</h2>
                    <p><a href="https://traefik.io" target="_blank" rel="nofollow noopener noreferrer">Traefik</a> is a reverse proxy / load balancer that is easy, dynamic, automatic, fast, full-featured, open source, production proven, and that provides metrics and integrates with every major cluster technology.</p>
                    <p>This tool will help you to define your own routes for your client, api and more generally for your containers.</p>
                    <p>Use this custom API Platform <code>docker-compose.yml</code> file which implements ready-to-use Traefik container configuration.<br>
                        Override ports and add labels to tell Traefik to listen on the routes mentionned and redirect routes to specified container.</p>
                    <p>
                        <code>--api</code> Tells Traefik to generate a browser view to watch containers and IP/DNS associated easier<br>
                        <code>--docker</code> Tells Traefik to listen on Docker Api<br>
                        <code>labels:</code> Key for Traefik configuration into Docker integration
                    </p>
HTML
			,
			<<<HTML
	<p>
                    The API DNS will be specified with
                    <code>traefik.frontend.rule=Host:your.host</code>
                    (here api.localhost)
                </p>
                <p>
                    <code>--traefik.port=3000</code>
                    The port specified to Traefik will be exposed by the container (here the React app exposes the 3000
                    port)
                </p>
HTML
			,
			<<<HTML
	<p>Don''t forget the db-data, or the database won''t work in this dockerized solution.</p>
                <p><code>localhost</code> is a reserved domain referred to in your <code>/etc/hosts</code>.
                    If you want to implement custom DNS such as production DNS in local, just add them at the end of
                    your <code>/etc/host</code> file like that: </p>
HTML
			,
			<<<HTML
	<p>If you do that, you''ll have to update the <code>CORS_ALLOW_ORIGIN</code>
                    environment variable <code>api/.env</code> to accept the specified URL.</p>
                <h2 id="known-issues"><a href="#known-issues" aria-label="known issues permalink" class="anchor"></a>Known
                    Issues</h2>
                <p>If your network is of type B, it may conflict with the Traefik sub-network.</p>
                <h2 id="going-further"><a href="#going-further" aria-label="going further permalink" class="anchor"></a>Going
                    Further</h2>
                <p>As this Traefik configuration listens on 80 and 443 ports, you can run only 1 Traefik instance per
                    server. However, you may want to run multiple API Platform projects on same server. To deal with it,
                    you''ll have to externalize the Traefik configuration to another <code>docker-compose.yml</code>
                    file, anywhere on your server.
                    Here is a working example: </p>
HTML
			,
			<<<HTML
	<p>Then update the <code class="language-text">docker-compose.yaml</code> file belonging to your API Platform projects: </p>
HTML
			,
			<<<HTML
	<p>Finally, some environment variables must be defined, here is an example of a <code>.env</code> file to set them: </p>
HTML
			,
			<<<HTML
	<p>This way, you can configure your main variables into one single file.</p>
HTML
		];
	}

	public function up(Schema $schema): void
	{
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

		$this->article = $this->connection->fetchAll("SELECT id FROM article")[0]['id'];
		$this->insertTexts();
		$this->insertCodePackages(6);
	}

	public function down(Schema $schema): void
	{
		// this down() migration is auto-generated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

		$this->addSql(<<<SQL
DELETE FROM text WHERE 1;
SQL
		);
		$this->addSql(<<<SQL
DELETE FROM code_package WHERE 1;
SQL
		);
	}
}
