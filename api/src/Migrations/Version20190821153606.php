<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\AbstractTextMigration;
use Doctrine\DBAL\Schema\Schema;

final class Version20190821153606 extends AbstractTextMigration
{
	public function getDescription() : string
	{
		return 'Populating translations and texts for second article';
	}

	protected function getTexts(): array
	{
		return [
			<<<HTML
                <h2 id="install">Install</h2>
                <h3 id="nodejs-docker-image-definition">Node.js docker image definition</h3>
                <p>Create an express server using Nodejs. First create a Dockerfile containing this content</p>
HTML
			,
			<<<HTML
<p>Update your <code>package.json</code> scripts to :</p>
HTML
			,
			<<<HTML
<p>Then define image to <code>docker-compose</code> file</p>
HTML
			,
			<<<HTML
<h2 id="express-server-routes-mapping-redux-implémentation">Express server + routes mapping + redux implementation</h2>
                <p>Require all needed dependencies</p>
HTML
			,
			<<<HTML
<p>We trust that you have two files <code>Welcome.js</code> and <code>Book.js</code> located into <code>client/src</code> and one action using axios fetching and reducer</p>
HTML
			,
			<<<HTML
 
HTML
			,
			<<<HTML
 
HTML
			,
			<<<HTML
<p>Create a directory named <code>server</code> inside <code>client</code> folder then create two files <code>index.js</code> <code>render.js</code>.<br />
                    <code>index.js</code> will contain the express server setup and <code>render.js</code> the render part</p>
HTML
			,
			<<<HTML
 
HTML
			,
			<<<HTML
 
HTML
			,
			<<<HTML
<p>You can see in code the paths <code>../src/routes</code> and <code>../src/reducers</code> are called. These files contain respectively your routes list and reducers list</p>
HTML
			,
			<<<HTML
 
HTML
			,
			<<<HTML
<h2 id="babel-webpack">Babel + Webpack</h2>
                <p>Add babel and webpack and babel dependencies :</p>
HTML
			,
			<<<HTML
<p>Define <code>.babelrc</code> file into client folder</p>
HTML
			,
			<<<HTML
<p>Then define 2 files named <code>webpack.build.config.js</code> and <code>webpack.server.config.js</code> into client folder</p>
HTML
			,
			<<<HTML
 
HTML
			,
			<<<HTML
<p>Then build your react app <code>docker-compose exec client yarn client-build</code>.<br />
                    Build your app to be minified for nodejs ssr <code>docker-compose exec client yarn server-build</code>.<br />
                    Build the nodejs image to update server.js generated file and refresh cache <code>docker-compose build nodejs-ssr</code>.<br />
                    Then just up the container <code>docker-compose up -d</code> and browse to <a href="http://localhost:8082">http://localhost:8082</a>, you''ll see your pre-rendered page.</p>
                <p>At least test your page, it should be rendered in <a href="https://search.google.com/search-console">Google search console tool</a>.</p>
HTML
		];
	}

	public function up(Schema $schema) : void
	{
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

		$this->article = $this->connection->fetchAll("SELECT id FROM article ORDER BY created_at")[1]['id'];
		$this->insertTexts(17);
		$this->insertCodePackages(16);
	}

	public function down(Schema $schema) : void
	{
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

		$this->addSql(<<<SQL
DELETE FROM translations_text WHERE 1;
SQL
		);
		$this->addSql(<<<SQL
DELETE FROM text WHERE 1;
SQL
		);
		$this->addSql(<<<SQL
DELETE FROM code WHERE 1;
SQL
		);
		$this->addSql(<<<SQL
DELETE FROM code_package WHERE 1;
SQL
		);
	}
}
