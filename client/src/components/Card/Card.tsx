import React from 'react';
import { ConferenceInstance } from '../../actions';
import { Link } from 'react-router-dom';

interface CardInterface {
    basepath: string;
    item: ConferenceInstance;
}

export const Card: React.FC<CardInterface> = ({ basepath, children, item }) => {
    return (
        <Link
            to={`${ basepath }/${ [item.city.toLowerCase(), item.date.toISOString().split('T')[0]].join('-') }`}
            className='card text-white conference-card'>
            <img className='card-img img-fit' src={`https://sylvaincdn.000webhostapp.com/devcv/${ item.image }`} alt='Card image'/>
            <div className='card-img-overlay d-flex transition pointer'>
                <div className='m-auto text-center transition'>
                    {
                        children ?
                            children :
                            (
                                <>
                                    <span className='d-block card-title display-4 font-weight-bolder'>{ item.city }</span>
                                    <span className='d-block card-text font-weight-bold m-0'>{ item.name }</span>
                                    <span className='d-block card-text font-weight-bold m-0'>{ item.date.toLocaleDateString() }</span>
                                </>
                            )
                    }
                </div>
            </div>
        </Link>
    );
}
