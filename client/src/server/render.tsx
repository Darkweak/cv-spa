import React from 'react';
import path from 'path';
import { renderToString } from 'react-dom/server';
import { Route, StaticRouter, Switch } from 'react-router-dom';
import { IRoute, routes } from '../routes';
import { BaseStoreProvider } from '../contexts/BaseStoreContext';
import { LanguageProvider } from '../contexts';
import { ChunkExtractor } from '@loadable/server';

const base_url = process.env.REACT_APP_DOMAIN || '';
const script_url = 'https://sylvaincdn.000webhostapp.com/devcv';
const description = 'Sylvain COMBRAQUE - CV';
const icon = '/favicon.png';
const name = 'devcv';

const statsFile = path.resolve('./public/dist/loadable-stats.json');

export const render = (context: any, path: string, state: any) => {
    const chunkExtractor = new ChunkExtractor({
        publicPath: `${ script_url }/dist`,
        statsFile,
    });
    const content = renderToString(
        <BaseStoreProvider>
            <StaticRouter location={path} context={context}>
                <Switch>
                    { routes.map((route: IRoute, index: number) => {
                        const Tag: any = route.component;
                        return <Route
                            key={index}
                            exact
                            path={`/:language([a-z]{2})?${ '/' === route.path ? '' : route.path }`}
                            render={() => <LanguageProvider><Tag/></LanguageProvider>}
                        />
                    })}
                </Switch>
            </StaticRouter>
        </BaseStoreProvider>
    );

    return `<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <meta name="theme-color" content="#000000">
    <meta name="description" content="${ description }" />
    <link rel="shortcut icon" href="${ base_url }${ icon }">
    <meta itemprop="name" content="${ name }">
    <meta itemprop="image" content="${ base_url }${ icon }">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@darkweak_dev">
    <meta name="twitter:title" content="${ name }">
    <meta name="twitter:description" content="${ description }">
    <meta name="twitter:creator" content="@darkweak_dev">
    <meta name="twitter:image:src" content="${ base_url }${ icon }">
    <meta property="og:title" content="${ name }">
    <meta property="og:type" content="website">
    <meta property="og:url" content="${ base_url }${ path }">
    <meta property="og:image" content="${ base_url }${ icon }">
    <meta property="og:description" content="${ description }">
    <meta property="og:site_name" content="${ name }">
    <link rel="canonical" href="${ base_url }${ path }" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/shards-ui@latest/dist/css/shards.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/highlightjs@9.12.0/styles/tomorrow.css">
    <link rel="stylesheet" href="/dist/main.css"/>
    <title>${ process.env.REACT_APP_NAME }</title>
  </head>
  <body>
    <noscript>
    </noscript>
    <div id="root">${ content }</div>
    <script>window.INITIAL_STATE = ${ JSON.stringify(state) }</script>
    ${chunkExtractor.getScriptTags()}
  </body>
</html>`;
};
