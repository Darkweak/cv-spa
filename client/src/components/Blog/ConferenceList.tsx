import React, { useEffect, useState } from 'react';
import { Conference, ConferenceInstance } from '../../actions';
import './cardOverlay.scss';
import { Link } from 'react-router-dom';
import { Loading } from '../Loader';

interface ConferenceListInterface {
    loadingText?: string;
    max?: number;
    perRow?: number;
}

const ConferenceListItem = ({ item }: { item: ConferenceInstance }) => (
    <Link
        to={`/conferences/${ [item.city.toLowerCase(), item.date.toISOString().split('T')[0]].join('-') }`}
        className='card text-white conference-card'>
        <img className='card-img img-fit' src={`https://sylvaincdn.000webhostapp.com/devcv/${ item.image }`} alt='Card image'/>
        <div className='card-img-overlay d-flex transition pointer'>
            <div className='m-auto text-center transition'>
                <span className='d-block card-title display-4 font-weight-bolder'>{ item.city }</span>
                <span className='d-block card-text font-weight-bold m-0'>{ item.name }</span>
                <span className='d-block card-text font-weight-bold m-0'>{ item.date.toLocaleDateString() }</span>
            </div>
        </div>
    </Link>
);

export const ConferenceList: React.FC<ConferenceListInterface> = ({ loadingText, max, perRow = 2 }) => {
    const [conferences, setConferences] = useState<ConferenceInstance[]>([]);
    useEffect(() => {
        new Conference({ filters: { perPage: (max || '').toString() } }).getAll().then(setConferences);
    }, []);

    return (
        <div className='row m-0'>
            {
                !conferences.length ?
                    <div className='py-4 w-100'>
                        <Loading text={`conference.list.${ loadingText || 'default' }`}/>
                    </div> :
                    conferences.map((conference, index) => (
                        <div className={`col-md-${ 12 / perRow } p-2`} key={ index }>
                            <ConferenceListItem item={ conference }/>
                        </div>
                    ))

            }
        </div>
    );
};
