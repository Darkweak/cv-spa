import React, { useContext } from 'react';
import { ClassNameInterface } from '../Layout';
import { Link as RLink, LinkProps } from 'react-router-dom';
import { LanguageContext } from '../../contexts';

interface CustomLinkInterface extends ClassNameInterface {
    href: string;
}

export const CustomLink: React.FC<CustomLinkInterface> = ({children, className, href}) => (
    <a target='_blank' rel='noopener noreferrer' className={`${className || 'text-muted'} no-decoration`}
       href={href}>{children}</a>
);

export const Link: React.FC<LinkProps> = ({
    children,
    className,
    to
}) => {
    const { language } = useContext(LanguageContext);
    return (
        <RLink className={className} to={`/${ language }${ to }`}>
            { children }
        </RLink>
    );
};
