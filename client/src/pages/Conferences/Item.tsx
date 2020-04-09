import React, { useContext, useEffect, useState } from 'react';
import { WavyHeader } from '../../components/Wave';
import { FadeInFromBottom } from '../../components/Visible';
import { Layout } from '../../components/Layout';
import { useParams } from 'react-router-dom';
import { ConferenceItem } from '../../components/Conference';
import { Container } from 'react-bootstrap';
import { Conference, ConferenceInstance } from '../../actions';
import { BaseStoreContext, SET_CONFERENCE } from '../../contexts/BaseStoreContext';
import { PageType } from '../interface';
import { List } from './List';

export const Item: PageType = () => {
    const { city, date } = useParams();
    const { conference: { [`${ city }-${ date }`]: baseConference }, dispatch } = useContext(BaseStoreContext);
    const [conference, setConference] = useState<ConferenceInstance|undefined>(baseConference);
    useEffect(() => {
        new Conference().get({ id: `${ city }-${ date }` }).then(conference => {
            setConference(conference);
            dispatch({
                payload: conference,
                type: SET_CONFERENCE,
            })
        });
    }, [city, date, dispatch]);
    return (
        <Layout title={conference?.name}>
            <WavyHeader>
                <FadeInFromBottom className='mx-auto text-uppercase container'>
                    <h1 className='text-center font-weight-lighter text-white m-auto col-12 pb-4 pb-sm-0'>
                        { conference ? conference.name : 'Conference en cours de chargement' }
                    </h1>
                </FadeInFromBottom>
            </WavyHeader>
            <div className={`bg-light pb-4`}>
                <Container>
                    <ConferenceItem conference={conference}/>
                </Container>
            </div>
        </Layout>
    );
};

Item.getInitialProps = ([,,, slug]: [string, string, string, string]) => {
    return [
        new Conference()
            .get({ id: slug })
            .then(conference => ({
                conference: {
                    [`${ conference.city }-${ conference.date }`]: conference
                }
            }))
    ];
};
