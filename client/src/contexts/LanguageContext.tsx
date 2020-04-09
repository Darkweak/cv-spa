import React, { createContext, Dispatch, SetStateAction, useEffect, useState } from 'react';
import { languages } from '../i18n/i18n';
import { ClientProvider } from './ClientContext';
import { hasWindow, Language } from '../helpers';
import { useParams, useLocation, useRouteMatch, useHistory } from 'react-router';

interface PageTranslationInterface {
    wave: {
        title: string;
        subtitle: string;
    }
}

interface TranslationInterface {
    navbar: {
        account: {
            label: string;
            login: string;
            logout: string;
            register: string;
        };
        about: string;
        contact: string;
        home: string;
        language: {
            label: string,
            fr: string,
            en: string
        }
    };
    pages: {
        conferences: PageTranslationInterface;
        contact: PageTranslationInterface;
        home: PageTranslationInterface;
    };
}

export interface LanguageInterface {
    [key: string]: TranslationInterface;
}

const findTranslation = (
    keys: string[],
    translations: any /*eslint-disable-line*/
): string | undefined => {
    const key = keys[ 0 ];
    if (keys.length && translations[ key.toString() ]) {
        keys.shift();
        return findTranslation(keys, translations[ key.toString() ]);
    } else if (!keys.length) {
        return translations;
    }
    return undefined;
};

export type AllowedLanguages = 'en' | 'fr'
const allowedLanguages = ['en', 'fr'];

interface ILanguageContext {
    language: AllowedLanguages;
    translate: (value: string) => string,
    setSelectedLanguage: (language: AllowedLanguages) => void;
}

const defaultState: ILanguageContext = {
    language: 'en',
    translate: (value: string) => value,
    setSelectedLanguage: (value: AllowedLanguages) => null,
};

const getInitialState = (language?: string): AllowedLanguages => {
    const state = (
        language ||
        (new Language().get() as AllowedLanguages) ||
        ((hasWindow() && navigator.language.split('-')[0] as AllowedLanguages) || '')
    );

    if (allowedLanguages.includes(state)) {
        return (state as AllowedLanguages);
    } else {
        return 'en';
    }
};

export const LanguageContext = createContext<ILanguageContext>(defaultState);

export const LanguageProvider: React.FC = ({children}) => {
    const regexp = new RegExp('/[a-z]{2}/');
    const { language: l } = useParams();
    const { url } = useRouteMatch();
    const { pathname } = useLocation();
    const { push } = useHistory();
    const [language, setLanguage]: [AllowedLanguages, Dispatch<SetStateAction<AllowedLanguages>>] = useState<AllowedLanguages>(getInitialState(l));
    useEffect(() => {
        if (!pathname.match(`^/(${ language })(/|$)`)) {
            const path = url.split(regexp)[1];
            push(`/${ language }${ path ? `/${ path }` : '' }`);
        };
    }, [language, pathname, push, regexp, url]);
    const translate = (value: string): string => findTranslation(value.split('.'), languages[ language ]) || value;
    return (
        <LanguageContext.Provider
            value={{
                language,
                translate,
                setSelectedLanguage: (language: AllowedLanguages): void => {
                    new Language().set(language);
                    setLanguage(language);
                },
            }}
        >
            <ClientProvider>
                {children}
            </ClientProvider>
        </LanguageContext.Provider>
    );
};
