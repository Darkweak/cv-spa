import {
    Contact,
    BlogItem,
    BlogList,
    Item as ConferenceItem,
    List as ConferenceList,
    Login,
    Welcome
} from './pages';
import { AllowedLanguages } from './contexts';
import { RouteProps } from 'react-router-dom';
import { IconInterface } from './components/Layout';

export interface IRoute extends RouteProps {
    changeLanguage?: (setSelectedLanguage: (language: AllowedLanguages) => void) => void,
    handleClick?: ((...v: any) => void) | boolean,
    icon: IconInterface,
    name: string,
    realPath?: string,
}

export const connexionRoutes: IRoute[] = [
    {
        component: Login,
        icon: {
            icon: 'input'
        },
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
        name: 'blog',
        path: '/blog/:slug',
        realPath: '',
    },
    {
        component: ConferenceItem,
        icon: {
            icon: '',
        },
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
        name: 'home',
        path: '/',
        realPath: '/',
    },
    {
        component: ConferenceList,
        icon: {
            icon: 'microphone',
        },
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
        name: 'blog',
        path: '/blog',
        realPath: '/blog',
    },
    {
        component: Contact,
        icon: {
            icon: 'envelope'
        },
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
