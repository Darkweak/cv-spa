import express from 'express';
import path from 'path';
import { navbarRoutes, routes } from "../routes";
import { Article, ArticleInstance, Conference, ConferenceInstance } from '../actions';
import { matchRoutes } from 'react-router-config';
import { render } from './render';

const PORT = 3000;
const app = express();
app.use(express.static(path.join(__dirname, '../../public')));
app.use('/favicon.png', express.static('public/favicon.png'));
app.use('/dist', express.static('public/dist'));

app.get('/sitemap', async (req: any, res: any) => {
    let content: any[] = [];
    const languages: string[] = ['en', 'fr'];
    const date = new Date().toISOString().split('T')[ 0 ];
    const routeList: { path: string }[] = languages.map(l => navbarRoutes.map(({path}) => ({ path: `/${l}${path}` }))).flat();
    await Promise.all([
        new Article().getAll(),
        new Conference().getAll(),
    ]).then(([
        articles,
        conferences
    ]: [ArticleInstance[], ConferenceInstance[]]) => {
        articles.forEach(article => {
            const t: any = article.translations;
            Object
                .keys(t)
                .map((l) => routeList.push({ path: `/blog/${ l }/${ t[l].slug }` }));
        });
        conferences.forEach(conference => routeList.push({ path: conference.to }));
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
                []
        )
        .map(action => actions.push(...action));

    await Promise
        .all(actions)
        .then((result: any) => result.forEach(
            (r: any) => state = {...state, ...r}
        )).catch(console.log);

    const content = render({}, req.path, state);
    res.send(content);
});

app.listen(PORT, () => console.log(`Frontend service listening on port: ${PORT}`));
