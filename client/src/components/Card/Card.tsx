import React from 'react';
import { ArticleInstance, ConferenceInstance, CreationInstance } from '../../actions';
import './cardOverlay.scss';
import { CustomLink, Link } from '../CustomLink';

type CardItemType = ConferenceInstance | ArticleInstance | CreationInstance

interface CardInterface {
    item: CardItemType & {
        to?: string;
        href?: string;
    };
}

const CommonCard: React.FC<CardInterface> = ({ children, item }) => (
    <>
        <img
            loading="lazy"
            className='card-img img-fit'
            src={ `https://sylvaincdn.000webhostapp.com/devcv${ item.image }` }
            alt={`${ item.name } card`}/>
        <div className='card-img-overlay d-flex transition pointer'>
            <div className='m-auto text-center transition'>
                { children }
            </div>
        </div>
    </>
)

export const Card: React.FC<CardInterface> = ({ children, item }) => {
    return (
        item.href ?
            <CustomLink
                href={item.href}
                className='card text-white text-decoration-none conference-card'>
                <CommonCard {...{children, item}}/>
            </CustomLink> :
            <Link
                to={item.to || ''}
                className='card text-white text-decoration-none conference-card'>
                <CommonCard {...{children, item}}/>
            </Link>
    );
};
