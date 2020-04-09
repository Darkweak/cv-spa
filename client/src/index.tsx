import React from 'react';
import ReactDOM from 'react-dom';
import './app.scss';
import { BrowserRouter, Route, Switch } from 'react-router-dom';
import { createBrowserHistory } from 'history';
import { IRoute, routes } from './routes';
import { LanguageProvider } from './contexts';
import { BaseStoreProvider } from './contexts/BaseStoreContext';

export const history: any = createBrowserHistory();

ReactDOM.render(
    <BaseStoreProvider>
        <BrowserRouter>
            <Switch>
                {
                    routes.map(
                        (route: IRoute, index: number) => {
                            const Tag: any = route.component;
                            return <Route
                                key={index}
                                exact
                                path={`/:language([a-z]{2})?${ '/' === route.path ? '' : route.path }`}
                                render={() => <LanguageProvider><Tag/></LanguageProvider>}
                            />
                        }
                    )
                }
            </Switch>
        </BrowserRouter>
    </BaseStoreProvider>
    ,
    document.getElementById('root')
);

