import {
    BlogItem,
    BlogList,
    Contact,
    CreationList,
    Item as ConferenceItem,
    List as ConferenceList,
    Login,
    Welcome
} from './pages';
import { AllowedLanguages } from './contexts';
import { RouteProps } from 'react-router-dom';
import { IconInterface } from './components/Layout';
import Skills from './pages/Skills';
import Career from './pages/Career';

export interface IRoute extends RouteProps {
    changeLanguage?: (setSelectedLanguage: (language: AllowedLanguages) => void) => void,
    handleClick?: ((...v: any) => void) | boolean,
    icon: IconInterface,
    modulePath?: string,
    name: string,
    realPath?: string,
}

export const connexionRoutes: IRoute[] = [
    {
        component: Login,
        icon: {
            icon: 'input'
        },
        modulePath: './pages/Login',
        name: 'account.login',
        path: '/login',
    },
];

export const languageRoutes: IRoute[] = [
    {
        changeLanguage: (setSelectedLanguage) => setSelectedLanguage('fr'),
        handleClick: true,
        icon: {
            icon: ''
        },
        name: 'language.fr',
        path: '/language.fr',
        strict: true,
        exact: true,
    },
    {
        changeLanguage: (setSelectedLanguage) => setSelectedLanguage('en'),
        exact: true,
        handleClick: true,
        icon: {
            icon: ''
        },
        name: 'language.en',
        path: '/language.en',
        strict: true,
    },
];

export const otherRoutes: IRoute[] = [
    {
        component: BlogItem,
        icon: {
            icon: '',
        },
        modulePath: './pages/Blog/Item',
        name: 'blog',
        path: '/blog/:slug',
        realPath: '',
    },
    {
        component: ConferenceItem,
        icon: {
            icon: '',
        },
        modulePath: './pages/Conferences/Item',
        name: 'conferences',
        path: '/conferences/:city([a-z]+)-:date([0-9]{4}-[0-9]{2}-[0-9]{2})',
        realPath: '',
    }
];

export const navbarRoutes: IRoute[] = [
    {
        component: Welcome,
        exact: true,
        icon: {
            icon: 'home',
        },
        modulePath: './pages/Welcome',
        name: 'home',
        path: '/',
        realPath: '/',
    },
    {
        component: ConferenceList,
        icon: {
            icon: 'microphone',
        },
        modulePath: './pages/Conferences/List',
        name: 'conferences',
        path: '/conferences',
        realPath: '/conferences',
    },
    {
        component: BlogList,
        icon: {
            icon: 'newspaper',
            type: 'far'
        },
        modulePath: './pages/Blog/List',
        name: 'blog',
        path: '/blog',
        realPath: '/blog',
    },
    {
        component: Career,
        icon: {
            icon: 'newspaper',
            type: 'far'
        },
        modulePath: './pages/Career',
        name: 'career',
        path: '/career',
        realPath: '/career',
    },
    {
        component: Skills,
        icon: {
            icon: 'newspaper',
            type: 'far'
        },
        modulePath: './pages/Skills',
        name: 'skills',
        path: '/skills',
        realPath: '/skills',
    },
    {
        component: CreationList,
        icon: {
            icon: 'palette',
        },
        modulePath: './pages/Creations/List',
        name: 'creations',
        path: '/creations',
        realPath: '/creations',
    },
    {
        component: Contact,
        icon: {
            icon: 'envelope'
        },
        modulePath: './pages/Contact',
        name: 'contact',
        path: '/contact',
    }
];

export const routes: IRoute[] = [
    ...otherRoutes,
    ...navbarRoutes,
    ...connexionRoutes,
    ...languageRoutes,
];
