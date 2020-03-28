import React, { useEffect, useState } from 'react';
import { Conference, ConferenceInstance } from '../../actions';
import './cardOverlay.scss';
import { Loading } from '../Loader';
import { Card } from '../Card';

interface ConferenceListInterface {
    loadingText?: string;
    max?: number;
    perRow?: number;
}

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
                            <Card basepath='/conferences' item={ conference }/>
                        </div>
                    ))

            }
        </div>
    );
};
