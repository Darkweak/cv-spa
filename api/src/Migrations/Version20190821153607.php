<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\AbstractTranslatedTextMigration;
use Doctrine\DBAL\Schema\Schema;

final class Version20190821153607 extends AbstractTranslatedTextMigration
{
    public function getDescription() : string
    {
        return 'Populating translations and texts articles';
    }

	protected function getTranslatedTextsFR(): array
	{
		return [
			<<<HTML
                <h2 id="installation">Installation</h2>
                <h3 id="definition-de-l-image-docker-node-js">Définition de l''image docker Node.js</h3>
                <p>Créez un serveur express en utilisant Nodejs. Tout d''abord créons le Dockerfile qui contiendra ceci</p>
HTML
			,
			<<<HTML
<p>Mettez à jour vos scripts dans le <code>package.json</code> avec ceci :</p>
HTML
			,
			<<<HTML
<p>Puis définissez une image dans le fichier <code>docker-compose</code></p>
HTML
			,
			<<<HTML
<h2 id="serveur-express-mapping-des-routes-implémentation-de-redux">Serveur express + mapping des routes + implémentation de redux</h2>
                <p>Requirez toutes les dépendances nécessaires</p>
HTML
			,
			<<<HTML
<p>Partons du principe que vous avez deux fichiers <code>Welcome.js</code> et <code>Book.js</code> situés dans <code>client/src</code> et une action utilisant axios ainsi qu''un reducer</p>
HTML
			,
			<<<HTML
 
HTML
			,
			<<<HTML
 
HTML
			,
			<<<HTML
<p>Créez un dossier nommé <code>server</code> dans le dossier <code>client</code> puis créez deux fichiers <code>index.js</code> et <code>render.js</code>.<br />
                    <code>index.js</code> contiendra l''initialisation du serveur express et <code>render.js</code> la partie rendu</p>
HTML
			,
			<<<HTML
 
HTML
			,
			<<<HTML
 
HTML
			,
			<<<HTML
<p>Vous pouvez remarquer dans le code l''appel aux chemin <code>../src/routes</code> et <code>../src/reducers</code>. Ces fichiers contiennent respectivement la liste de vos routes ainsi que la liste de vos reducers</p>
HTML
			,
			<<<HTML
 
HTML
			,
			<<<HTML
<h2 id="babel-webpack">Babel + Webpack</h2>
                <p>Ajoutez les dépendances de babel et webpack :</p>
HTML
			,
			<<<HTML
<p>Créez un fichier <code>.babelrc</code> dans le dossier client</p>
HTML
			,
			<<<HTML
<p>Puis definissez deux fichiers nommés <code>webpack.build.config.js</code> et <code>webpack.server.config.js</code> dans le dossier client</p>
HTML
			,
			<<<HTML
 
HTML
			,
			<<<HTML
<p>Lancez un build de votre application React avec la commande <code>docker-compose exec client yarn client-build</code>.<br />
                    Minifiez vos scripts pour node en lançant <code>docker-compose exec client yarn server-build</code>.<br />
                    Construisez l''image nodejs pour mettre à jour le serveur.js généré et mettre à jour le cache <code>docker-compose build nodejs-ssr</code>.<br />
                    Puis il vous suffit de relancer le conteneur en lançant <code>docker-compose up -d</code> et rendez vous sur <a href="http://localhost:8082">http://localhost:8082</a>, vous verrez votre page pré-rendue.</p>
                <p>Enfin, testez votre page, elle devrait être rendue dans <a href="https://search.google.com/search-console">l''outil Google search Console</a>.</p>
HTML
		];
	}

	protected function getTranslatedTextsEN(): array
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

	protected function getCodes(): array
	{
		return [
			[
				"name" => "dockerfile",
				"content" => <<<'EOT'
# client/Dockerfile-SSR
FROM node:alpine

WORKDIR /app

RUN apk update &amp;&amp; \
 apk upgrade &amp;&amp; \
 rm -rf /var/cache/apk/*

COPY package.json ./

COPY . .

RUN npm install
RUN npm run server-build

CMD [ "yarn", "server-start" ]
EOT
			],
			[
				"name" => "json",
				"content" => <<<'EOT'
    "client-build": "webpack --config webpack.build.config.js",
    "server-build": "webpack --config webpack.server.config.js",
    "server-start": "node server.js",
EOT
			],
			[
				"name" => "yaml",
				"content" => <<<'EOT'
# docker-compose.yml
...

+  nodejs-ssr:
+    build:
+      context: ./client
+      dockerfile: Dockerfile-ssr
+    volumes:
+      - ./client:/app:rw,cached
+      - ./client/node_modules:/app/node_modules
+    env_file:
+      - ./client/.env # Share client .env file between client and nodejs server
+    ports:
+      - "8082:8082" # Nodejs express server will run on port 8082
EOT
			],
			[
				"name" => "bash",
				"content" => <<<'EOT'
$ docker-compose exec client yarn add axios express history react react-dom react-redux react-router-config react-router-dom recompose redux redux-form redux-thunk
EOT
			],
			[
				"name" => "jsx",
				"content" => <<<'EOT'
// client/src/Welcome.js
import React from ''react'';
import { Link } from ''react-router-dom'';

export default () => <h1>You are on the welcome page, <Link to="/books">go to list of books</Link></h1>;
EOT
			],
			[
				"name" => "jsx",
				"content" => <<<'EOT'
// client/src/Book.js
import React from ''react'';
import { Link } from ''react-router-dom'';
import { connect } from ''react-redux'';
import { compose, lifecycle, setStatic } from ''recompose'';
import { fetchBooks } from ''./store/action'';

export const List = compose(
 connect(
   reducers => ({
     ...reducers.BookReducer
   }),
   {
     fetchBooks
   }
 ),
 lifecycle({
   componentDidMount() {
     const { fetchBooks } = this.props;
     fetchBooks();
   }
 }),
 setStatic(
   ''fetching'', ({ dispatch }) => [dispatch(fetchBooks())]
 ))(({ books }) => (
   <React.Fragment>
     <h1>You are on the welcome page, <Link to="/">go to homepage</Link></h1>
     <ul>
       {
         books.map((book, index) => <li key={ index }>{ book.name }</li>)
       }
     </ul>
   </React.Fragment>
));
EOT
			],
			[
				"name" => "js",
				"content" => <<<'EOT'
// client/src/store/action.js
export const BOOKS_LIST_FAILED = ''BOOKS_LIST_FAILED'';
export const BOOKS_LIST_SUCCESS = ''BOOKS_LIST_SUCCESS'';

export const fetchBooks = () => async (dispatch) => {
   try {
         let headers = {
             Accept: ''application/ld+json'',
             ''Content-Type'': ''application/ld+json''
         };
         const request = ({
             url: `${ process.env.REACT_APP_API_ENTRYPOINT }/books`,
             method: ''GET'',
             headers
         });
         const res = await axios.request(request);
         dispatch({
             type: BOOKS_LIST_SUCCESS,
             payload: res.data[ ''hydra:member'' ]
         });
     } catch (e) {
         dispatch({
             type: BOOKS_LIST_FAILED
         });
     }
};
EOT
			],
			[
				"name" => "js",
				"content" => <<<'EOT'
// client/src/store/reducer.js
import * as actions from ''./action'';

export const BookReducer = (state = {
 books: []
}, action) => {
 const {type, payload} = action;
 switch (type) {
   case actions.BOOKS_LIST_FAILED:
     return {
       ...state,
       books: []
     };
   case actions.BOOKS_LIST_SUCCESS:
     return {
       ...state,
       books: payload
     };
   default:
     return state;
 }
};
EOT
			],
			[
				"name" => "js",
				"content" => <<<'EOT'
// client/server/index.js
import express from ''express'';
import React from ''react'';
import thunk from ''redux-thunk'';
import { render } from ''./render'';
import { applyMiddleware, combineReducers, createStore } from ''redux'';
import { matchRoutes } from ''react-router-config'';
import { reducers } from "../src/reducers";
import { routes } from "../src/routes";

const PORT = 8082; // port defined in docker-compose file
const app = express();
const BUILD_DIR = ''dist'';

app.use(`/${ BUILD_DIR }`, express.static(`./${ BUILD_DIR }`));

app.get(''*'', async (req, res) => {
 const store = createStore(
   combineReducers({
     ...reducers
   }),
   {},
   applyMiddleware(thunk)
 ); //define store depending on each request

 try {
   const actions = matchRoutes(routes, req.path)
     .map(({ route }) => route.component.fetching ? route.component.fetching({...store, path: req.path }) : null) // Static method named fetching defined below
     .map(async actions => await Promise.all(
       (actions || []).map(p => p &amp;&amp; new Promise(resolve => p.then(resolve).catch(resolve)))
       ) // Execute static fetching method
     );

   await  Promise.all(actions);
   const context = {};
   const content = render(context, req.path, store);
   res.send(content);
 } catch (e) {
   console.log(e)
 }
});


app.listen(PORT, () => console.log(`SSR service listening on port: ${PORT}`));
EOT
			],
			[
				"name" => "jsx",
				"content" => <<<'EOT'
// client/server/render.js
import React from ''react'';
import { renderToString } from ''react-dom/server'';
import { Provider } from ''react-redux'';
import { StaticRouter } from ''react-router-dom'';
import { renderRoutes } from ''react-router-config'';
import { routes } from "../src/routes";

export const render = (context, path, store) => {
 const content = renderToString(
   <Provider store={store}>
     <StaticRouter location={path} context={context}>
       {
         renderRoutes(routes)
       }
     </StaticRouter>
   </Provider>
 );


 return `
<!DOCTYPE html>
<html lang="en">
 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="theme-color" content="#000000">
   <link rel="manifest" href="%PUBLIC_URL%/manifest.json">
   <link rel="shortcut icon" href="%PUBLIC_URL%/favicon.ico">
   <title>Welcome to API Platform</title>
 </head>
 <body>
   <noscript>
     You need to enable JavaScript to run this app.
   </noscript>
   <div id="root">${content}</div>
   <script>window.INITIAL_STATE = ${JSON.stringify(store.getState())}</script>
   <script src="/dist/bundle.js"></script>
 </body>
</html>
 `;
};
EOT
			],
			[
				"name" => "js",
				"content" => <<<'EOT'
// client/src/routes.js
import Welcome from "./components/Welcome";
import { List } from "./components/Book";

export const routes = [
    {
        component: List,
        path: ''/books''
    },
    {
        component: Welcome,
        path: ''/''
    }
];
EOT
			],
			[
				"name" => "js",
				"content" => <<<'EOT'
// client/src/reducer.js
import { BookReducer } from ''./store/reducer'';

export const reducers = {
 BookReducer
}
EOT
			],
			[
				"name" => "bash",
				"content" => <<<'EOT'
$ docker-compose exec client yarn add -D @babel/plugin-transform-runtime babel-plugin-css-modules-transform mini-css-extract-plugin webpack webpack-cli webpack-dev-server webpack-node-externals
EOT
			],
			[
				"name" => "js",
				"content" => <<<'EOT'
{
    "plugins": [
        "css-modules-transform",
        "@babel/plugin-transform-runtime"
    ],
    "presets": [
        "@babel/react",
        "@babel/env"
    ]
}
EOT
			],
			[
				"name" => "js",
				"content" => <<<'EOT'
// client/webpack.build.config.js
const webpack = require(''webpack'');
const path = require(''path'');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
  target: ''node'',
  mode: ''production'',
  entry: ''./src/index.js'',
  devtool: ''inline-source-map'',
  module: {
    rules: [
      {
        test: /\.css$/,
        resolve: {
          extensions: [''.css''],
        },
        use: [
          MiniCssExtractPlugin.loader,
          { loader: ''css-loader'', options: { sourceMap: true } },
          { loader: ''postcss-loader'', options: { sourceMap: true } }
        ],
      },
      {
        test: /\.jsx?$/,
        loader: ''babel-loader'',
        exclude: /node_modules/
      }
    ]
  },
  plugins: [
    new webpack.DefinePlugin({
      ''process.env'': {
        REACT_APP_API_ENTRYPOINT: JSON.stringify(process.env.REACT_APP_API_ENTRYPOINT)
      },
    }),
    new MiniCssExtractPlugin({
      filename: "[name].css",
      chunkFilename: "[id].css"
    })
  ],
  resolve: {
    extensions: [
      ''.js'',
      ''.css''
    ]
  },
  output: {
    globalObject: ''typeof self !== \''undefined\'' ? self : this'',
    filename: ''bundle.js'',
    path: path.resolve(__dirname, ''dist'')
  }
};
EOT
			],
			[
				"name" => "js",
				"content" => <<<'EOT'
// client/webpack.server.config.js
const webpack = require(''webpack'');
const path = require(''path'');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
 target: ''node'',
 mode: ''production'',
 entry: ''./server/index.js'',
 devtool: ''inline-source-map'',
 module: {
   rules: [
     {
       test: /\.css$/,
       resolve: {
         extensions: [''.css''],
       },
       use: [
         MiniCssExtractPlugin.loader,
         { loader: ''css-loader'', options: { sourceMap: true } },
         { loader: ''postcss-loader'', options: { sourceMap: true } }
       ],
     },
     {
       test: /\.jsx?$/,
       loader: ''babel-loader'',
       exclude: /node_modules/
     }
   ]
 },
 plugins: [
   new webpack.DefinePlugin({
     ''process.env'': {
       REACT_APP_API_ENTRYPOINT: JSON.stringify(process.env.REACT_APP_API_ENTRYPOINT)
     },
   }),
   new MiniCssExtractPlugin({
     filename: "[name].css",
     chunkFilename: "[id].css"
   })
 ],
 resolve: {
   extensions: [
     ''.js'',
     ''.css''
   ]
 },
 output: {
   globalObject: ''typeof self !== \''undefined\'' ? self : this'',
   path: path.resolve(__dirname),
   filename: ''server.js''
 },
};
EOT
			]
		];
	}

    public function up(Schema $schema) : void
    {
		$this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

		$article = $this->connection->fetchAll("SELECT id FROM article ORDER BY created_at")[1]['id'];
		$this->texts = $this->connection->fetchAll("SELECT id FROM text WHERE article_id = '$article'");
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
