import React, { useContext } from 'react';
import { WavyHeader } from '../../components/Wave';
import { FadeInFromBottom } from '../../components/Visible';
import { Layout } from '../../components/Layout';
import { ConferenceList } from '../../components/Conference';
import { Container } from 'react-bootstrap';
import { LanguageContext } from '../../contexts';
import { Conference } from '../../actions';
import { PageType } from '../interface';

export const List: PageType = () => {
    const { translate } = useContext(LanguageContext);
    return (
        <Layout title='pages.conferences.list.title'>
            <WavyHeader>
                <FadeInFromBottom className='mx-auto text-uppercase'>
                    <h1 className='text-center font-weight-lighter text-white m-auto col-12 pb-4 pb-sm-0'>
                        {translate('pages.conferences.wave.title')}
                    </h1>
                    <span className='h5 text-center font-weight-lighter text-white m-auto col-12'>
                        {translate('pages.conferences.wave.subtitle')}
                    </span>
                </FadeInFromBottom>
            </WavyHeader>
            <div className={`bg-light pb-4`}>
                <Container>
                    <ConferenceList conferenceContext='list'/>
                </Container>
            </div>
        </Layout>
    );
};

List.getInitialProps = () => {
    return [
        new Conference()
            .getAll()
            .then(conferences => ({
                conferences: {
                    conferences
                }
            }))
    ];
};
