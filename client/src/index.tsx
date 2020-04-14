import React from 'react';
import ReactDOM from 'react-dom';
import './app.scss';
import { BrowserRouter, Route, Switch } from 'react-router-dom';
import { createBrowserHistory } from 'history';
import { IRoute, routes } from './routes';
import { BaseStoreProvider } from './contexts/BaseStoreContext';
import loadable from '@loadable/component';
import { LanguageProvider } from './contexts';
import { Loading } from './components/Loader';

export const history: any = createBrowserHistory();

ReactDOM.render(
    <BaseStoreProvider>
        <BrowserRouter>
            <Switch>
                {
                    routes.map(
                        (route: IRoute, index: number) => (
                            <Route
                                component={() => (
                                    <LanguageProvider>
                                        {
                                            loadable(
                                                () => import(/* webpackPrefetch: true */ `${ route.modulePath }`),
                                                {
                                                    LoadingComponent: Loading,
                                                }
                                            ).render()
                                        }
                                    </LanguageProvider>
                                )}
                                key={ index }
                                exact
                                path={`/:language([a-z]{2})?${ route.path }`}
                            />
                        )
                    )
                }
            </Switch>
        </BrowserRouter>
    </BaseStoreProvider>
    ,
    document.getElementById('root')
);

