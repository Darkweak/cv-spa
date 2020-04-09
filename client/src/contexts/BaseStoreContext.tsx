import React, { createContext, Dispatch, useReducer } from 'react';
import { ArticleInstance, ConferenceInstance } from '../actions';
import { initialState } from '../helpers';

export const SET_ARTICLE = 'SET_ARTICLE';
export const SET_ARTICLES = 'SET_ARTICLES';
export const SET_CONFERENCE = 'SET_CONFERENCE';
export const SET_CONFERENCES = 'SET_CONFERENCES';

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
    |ConferenceInstance
    |ConferenceInstance[]
    |PayloadKVType;

type Action = {
    payload: PayloadType;
    type: string;
}

interface BaseStoreInterface {
    article: MappedKeyObjectType<ArticleInstance>,
    articles: ArticleInstance[],
    conference: MappedKeyObjectType<ConferenceInstance>,
    conferences: {
        [key: string]: ConferenceInstance[]
    },
    dispatch: Dispatch<Action>,
}

function fromInitialState<T>(
    t: MappedKeyObjectType<ArticleInstance|ConferenceInstance|string> = {},
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
    conference: fromInitialState<ConferenceInstance>(initialState?.conference),
    conferences: {
        list: (initialState?.conferences?.conferences) || [],
        welcome: (initialState?.welcome?.conferences) || []
    },
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
