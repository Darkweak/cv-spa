import React, { useContext, useEffect, useState } from 'react';
import { Conference, ConferenceInstance } from '../../actions';
import { Loading } from '../Loader';
import { Card } from '../Card';
import { BaseStoreContext, SET_CONFERENCES } from '../../contexts/BaseStoreContext';

interface ConferenceListInterface {
    conferenceContext: string;
    loadingText?: string;
    max?: number;
    perRow?: number;
}

export const ConferenceList: React.FC<ConferenceListInterface> = ({
    conferenceContext,
    loadingText,
    max,
    perRow = 2
}) => {
    const { conferences: { [conferenceContext]: list }, dispatch } = useContext(BaseStoreContext);
    const [conferences, setConferences] = useState<ConferenceInstance[]>(list || []);
    useEffect(() => {
        if (!list.length) {
            new Conference({ filters: { perPage: (max || '').toString() } })
                .getAll()
                .then(conferences => {
                    setConferences(conferences);
                    dispatch({
                        payload: {
                            key: conferenceContext,
                            value: conferences
                        },
                        type: SET_CONFERENCES,
                    })
                });
        }
    }, [conferenceContext, dispatch, list, max]);

    return (
        <div className='row m-0'>
            {
                conferences.length ?
                    conferences.map((conference, index) => (
                        <div className={`col-md-${ 12 / perRow } p-2`} key={ index }>
                            <Card item={ conference }>
                                <h2 className='d-block card-title fs-5 font-weight-bolder'>{ conference.city }</h2>
                                <span className='d-block card-text font-weight-bold m-0'>{ new Date(conference.date).toLocaleDateString() }</span>
                            </Card>
                        </div>
                    )) :
                    <Loading text={`conference.list.${ loadingText || 'default' }`}/>
            }
        </div>
    );
};
