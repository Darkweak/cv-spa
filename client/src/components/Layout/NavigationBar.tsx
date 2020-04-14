import React, { useContext, useEffect, useState } from 'react';
import { navbarRoutes } from '../../routes';
import './layout.scss';
import { Container, Nav, Navbar as BNavbar, NavDropdown as BNavDropdown } from 'react-bootstrap';
import { NavDropdown, NavLink } from './Navbar';
import { getWindow } from '../../helpers';
import { AllowedLanguages, LanguageContext } from '../../contexts';
import { Icon } from './Icon';

const MAX_SCROLL = 120;

interface LanguageInterface {
    value: AllowedLanguages,
    label: string,
}

const languages: LanguageInterface[] = [
    {
        value: 'en',
        label: 'English',
    },
    {
        value: 'fr',
        label: 'Français',
    },
];

export const NavBar = () => {
    const [top, setTop] = useState((getWindow()?.scrollY || 0) < MAX_SCROLL);
    const {language, setSelectedLanguage} = useContext(LanguageContext);

    const handleScroll = () => {
        setTop((getWindow()?.scrollY || 0) < MAX_SCROLL);
    };

    useEffect(() => {
        const w = getWindow();
        w?.addEventListener('scroll', handleScroll);

        return () => w?.removeEventListener('scroll', handleScroll);
    }, []);

    return (
        <>
            <BNavbar
                bg={top ? 'transparent' : 'gradient'}
                collapseOnSelect
                expand='lg'
                sticky='top'
                variant='dark'
            >
                <Container>
                    <BNavbar.Brand href='/'>&lt;devcv/&gt;</BNavbar.Brand>
                    <BNavbar.Toggle aria-controls='appbar'/>
                    <BNavbar.Collapse id='appbar'>
                        <Nav className='ml-auto'>
                            {
                                navbarRoutes.map((route, index) => (
                                    <NavLink key={index} route={route}/>
                                ))
                            }
                            <NavDropdown title='language' icon='language'>
                                {
                                    languages.map((l, index) => (
                                        <BNavDropdown.Item
                                            key={index}
                                            onClick={() => setSelectedLanguage(l.value)}
                                            active={language === l.value}
                                        >
                                            {l.label}
                                        </BNavDropdown.Item>
                                    ))
                                }
                            </NavDropdown>
                        </Nav>
                    </BNavbar.Collapse>
                </Container>
            </BNavbar>
            <div
                className={`return-to-top text-white fs-3 m-auto position-fixed transition z-5 rounded-circle pointer ${ top ? 'd-none' : 'd-flex' }`}
                onClick={() => window.scrollTo({ behavior: 'smooth', top: 0 })}>
                <Icon icon='angle-up' className='m-auto'/>
            </div>
        </>
    )
};
