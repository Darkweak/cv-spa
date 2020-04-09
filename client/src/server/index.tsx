import express from 'express';
import React from 'react';
import { navbarRoutes, routes } from "../routes";
import { Article, ArticleInstance, Conference, ConferenceInstance } from '../actions';
import { matchRoutes } from 'react-router-config';
import { render } from './render';

const PORT = 3000;
const app = express();
app.use('/dist', express.static('public/dist'));
app.use('/icon.png', express.static('public/icon.png'));

app.get('/sitemap', async (req: any, res: any) => {
    let content: any[] = [];
    const date = new Date().toISOString().split('T')[ 0 ];
    const routeList: { path: string }[] = navbarRoutes.map(r => ({ path: r.path as string }));
    await Promise.all([
        new Article().getAll(),
        new Conference().getAll(),
    ]).then(([
        articles,
        conferences
    ]: [ArticleInstance[], ConferenceInstance[]]) => {
        articles.map(article => {
            const t: any = article.translations;
            Object
                .keys(t)
                .map((l) => routeList.push({ path: `/blog/${ l }/${ t[l].slug }` }));
        });
        conferences.map(conference => routeList.push({ path: conference.to }));
    }).catch(console.log);
    routeList.map((sitemapRoute: { path: string }) => content.push(
        `<url>
    <loc>${process.env.REACT_APP_DOMAIN}${sitemapRoute.path}</loc>
    <lastmod>${date}</lastmod>
    <changefreq>daily</changefreq>
  </url>`
    ));

    res.header('Content-Type', 'text/xml');
    res.send(`<?xml version="1.0" encoding="UTF-8"?>
  <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    ${content.join('\n')}
  </urlset>
  `)
});

app.get('*', async (req: any, res: any) => {
    let state = {};
    const actions: any[] = [];
    matchRoutes(routes.map(r => ({ ...r, exact: true, path: `/:language([a-z]{2})${r.path}` })), req.path)
        .map(({ route }: any) =>
            route.component?.getInitialProps ?
                route.component.getInitialProps(req.path.split('/')) :
                null
        )
        .map(action => actions.push(...action));

    await Promise.all(actions).then((result: any) => {
        result.map((r: any) => {
            state = {...state, ...r}
        })
    }).catch(console.log);

    const content = render({}, req.path, state);
    res.send(content);
});

app.listen(PORT, () => console.log(`Frontend service listening on port: ${PORT}`));
