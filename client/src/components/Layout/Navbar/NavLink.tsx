import React, { useContext } from 'react';
import { Link } from '../../CustomLink';
import { IRoute } from '../../../routes';
import { useLocation } from 'react-router-dom';
import { ClientContext, LanguageContext } from '../../../contexts';
import { Icon } from '../Icon';

interface INavlink {
    route: IRoute
}

const isActiveLink = (route: IRoute, pathname: string) => {
    if ('/' === route.path) {
        return pathname.match(new RegExp(/^\/[a-z]{2}(\/)?$/))
    }
    return pathname.includes((route.path || '').toString())
}

export const NavLink = ({route}: INavlink) => {
    const {updateClient} = useContext(ClientContext);
    const { pathname } = useLocation();
    const {setSelectedLanguage, translate} = useContext(LanguageContext);
    return (
        <li className='nav-item'>
            <Link
                to={route.realPath || route.path as string}
                onClick={
                    (event: any) => {
                        if (route.handleClick) {
                            event.preventDefault();
                            if (route.changeLanguage) {
                                route.changeLanguage(setSelectedLanguage)
                            }
                            true !== route.handleClick && route.handleClick(updateClient)
                        }
                    }
                }
                className={`nav-link ${ isActiveLink(route, pathname) && 'active' }`}
            >
                <Icon {...route.icon}/>{' '}{translate(`navbar.${route.name}`)}
            </Link>
        </li>
    )
};
