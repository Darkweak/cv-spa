import React from 'react';
import { ConferenceInstance } from '../../actions';
import './cardOverlay.scss';
import { Link } from '../CustomLink';

interface CardInterface {
    item: ConferenceInstance;
}

export const Card: React.FC<CardInterface> = ({ children, item }) => {
    return (
        <Link
            to={item.to}
            className='card text-white text-decoration-none conference-card'>
            <div className='card-img-overlay d-flex transition pointer position-relative z-5 h-100'>
                <div className='m-auto text-center transition'>
                    {
                        children ?
                            children :
                            (
                                <>
                                    <h2 className='d-block card-title fs-5 font-weight-bolder'>{ item.city }</h2>
                                    <span className='d-block card-text font-weight-bold m-0'>{ new Date(item.date).toLocaleDateString() }</span>
                                </>
                            )
                    }
                </div>
            </div>
            <img
                className='position-absolute card-img img-fit'
                src={`https://sylvaincdn.000webhostapp.com/devcv/${ item.image }`}
                alt={`${ item.name } card`}/>
        </Link>
    );
}
