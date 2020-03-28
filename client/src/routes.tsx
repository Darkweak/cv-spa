import { Contact, Login, Welcome } from './components/pages';
import { AllowedLanguages } from './contexts';
import { RouteProps } from 'react-router-dom';
import { IconInterface } from './components/Layout';
import { List as ConferenceList } from './components/pages/Conferences';

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
        path: '',
    },
    {
        changeLanguage: (setSelectedLanguage) => setSelectedLanguage('en'),
        handleClick: true,
        icon: {
            icon: ''
        },
        name: 'language.en',
        path: '',
    },
];

export const loggedRoutes: IRoute[] = [
    {
        component: ConferenceList,
        icon: {
            icon: '',
        },
        name: 'conferences',
        path: '/conferences/:city([a-z]+)-:date([0-9]{4}\-[0-9]{2}\-[0-9]{2})',
        realPath: '/conferences/city',
    }
];

export const navbarRoutes: IRoute[] = [
    {
        component: Welcome,
        icon: {
            icon: 'home',
        },
        name: 'home',
        path: '/:language([a-z]{2})?',
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
        component: Contact,
        icon: {
            icon: 'envelope'
        },
        name: 'contact',
        path: '/contact',
    }
];

export const routes: IRoute[] = [
    ...loggedRoutes,
    ...navbarRoutes,
    ...connexionRoutes,
    ...languageRoutes,
];
