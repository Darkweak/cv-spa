import React, { createContext, Dispatch, useReducer } from 'react';
import { ArticleInstance, ConferenceInstance, CreationInstance } from '../actions';
import { initialState } from '../helpers';
import { CategoryInstance } from '../actions/category';
import { DiplomaInstance } from '../actions/diploma';
import { JobInstance } from '../actions/job';

export const SET_ARTICLE = 'SET_ARTICLE';
export const SET_ARTICLES = 'SET_ARTICLES';
export const SET_CATEGORIES = 'SET_CATEGORIES';
export const SET_CONFERENCE = 'SET_CONFERENCE';
export const SET_CONFERENCES = 'SET_CONFERENCES';
export const SET_CREATIONS = 'SET_CREATIONS';
export const SET_DIPLOMAS = 'SET_DIPLOMAS';
export const SET_JOBS = 'SET_JOBS';

type MappedKeyObjectType<T> = {
    [key: string]: T;
}

type ArticleType = { key: string, value: ArticleInstance }

type PayloadKVType = {
    key: string,
    value: ConferenceInstance[]
}
type PayloadType =
    |ArticleType
    |ArticleInstance[]
    |CategoryInstance[]
    |ConferenceInstance
    |ConferenceInstance[]
    |CreationInstance[]
    |DiplomaInstance[]
    |JobInstance[]
    |PayloadKVType;

type Action = {
    payload: PayloadType;
    type: string;
}

interface BaseStoreInterface {
    article: MappedKeyObjectType<ArticleInstance>,
    articles: ArticleInstance[],
    categories: CategoryInstance[],
    conference: MappedKeyObjectType<ConferenceInstance>,
    conferences: {
        [key: string]: ConferenceInstance[]
    },
    creations: CreationInstance[],
    diplomas: DiplomaInstance[],
    jobs: JobInstance[],
    dispatch: Dispatch<Action>,
}

function fromInitialState<T>(
    t: MappedKeyObjectType<ArticleInstance|ConferenceInstance|CreationInstance|string> = {},
    f: (v: string) => {} = v => v,
){
    return Object.fromEntries(
        Object
            .keys(t)
            .map(k => [
                k,
                (
                    (f(t[k].toString() || '{}') || t[k]) as T
                )
            ])
    )
}

const defaultValue: BaseStoreInterface = {
    article: fromInitialState<ArticleInstance>(initialState?.blogItem, v => JSON.parse(decodeURIComponent(v))),
    articles: (initialState?.blogList?.articles) || [],
    categories: [],
    conference: fromInitialState<ConferenceInstance>(initialState?.conference),
    conferences: {
        list: (initialState?.conferences?.conferences) || [],
        welcome: (initialState?.welcome?.conferences) || []
    },
    creations: (initialState?.creations?.creations) || [],
    diplomas: (initialState?.diplomas) || [],
    jobs: (initialState?.jobs) || [],
    dispatch: () => {}
};

const reducer = (
    state: BaseStoreInterface,
    { payload, type }: Action
): BaseStoreInterface => {
    switch (type) {
        case SET_ARTICLE:
            return {
                ...state,
                article: ({
                    ...state.article,
                    [(payload as ArticleType).key]: (payload as ArticleType).value
                } as MappedKeyObjectType<ArticleInstance>)
            };
        case SET_ARTICLES:
            return {
                ...state,
                articles: payload as ArticleInstance[]
            };
        case SET_CATEGORIES:
            return {
                ...state,
                categories: payload as CategoryInstance[]
            };
        case SET_CONFERENCE:
            const key = `${ (payload as ConferenceInstance).city.toLowerCase() }-${ (payload as ConferenceInstance).date }`;
            return {
                ...state,
                conference: ({
                    ...state.conference,
                    [key]: payload
                } as MappedKeyObjectType<ConferenceInstance>)
            };
        case SET_CONFERENCES:
            return {
                ...state,
                conferences: {
                    ...state.conferences,
                    [(payload as PayloadKVType).key]: ((payload as PayloadKVType).value) as ConferenceInstance[]
                }
            };
        case SET_CREATIONS:
            return {
                ...state,
                creations: payload as CreationInstance[]
            };
        case SET_DIPLOMAS:
            return {
                ...state,
                diplomas: payload as DiplomaInstance[]
            };
        case SET_JOBS:
            return {
                ...state,
                jobs: payload as JobInstance[]
            };
        default:
            return state;
    }
};

export const BaseStoreContext = createContext(defaultValue);

export const BaseStoreProvider: React.FC = ({children}) => {
    const [state, dispatch] = useReducer(reducer, defaultValue);

    return (
        <BaseStoreContext.Provider
            value={{...state, dispatch}}
        >
            {children}
        </BaseStoreContext.Provider>
    );
};
