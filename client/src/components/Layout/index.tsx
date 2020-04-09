import React, { useContext, useEffect } from 'react';
import { NavBar } from './NavigationBar';
import './layout.scss';
import { Footer } from './Footer';
import { LanguageContext } from '../../contexts';

export interface ClassNameInterface {
    className?: string;
}

interface LayoutInterface {
    title?: string;
}

export const Layout: React.FC<LayoutInterface> = ({children, title}) => {
    const { translate } = useContext(LanguageContext);
    useEffect(() => {
        document.title = translate(title || 'devcv | Sylvain COMBRAQUE');
    }, [title, translate]);

    return (
        <div className='bg-gradient'>
            <main>
                <NavBar/>
                <div className='pt-4'>
                    {children}
                </div>
            </main>
            <Footer/>
        </div>
    )
};

export * from './Footer';
export * from './Icon';
export * from './Navbar';
