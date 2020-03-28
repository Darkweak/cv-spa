import React from 'react';
import { WavyHeader } from '../../Wave';
import { FadeInFromBottom } from '../../Visible';
import { Layout } from '../../Layout';
import { ConferenceList } from '../../Conference';
import { Container } from 'react-bootstrap';
import { useParams } from 'react-router-dom';

export const List: React.FC = () => {
    const params = useParams();
    console.log(params);
    return (
        <Layout>
            <WavyHeader>
                <FadeInFromBottom className='mx-auto text-uppercase'>
                    <h1 className='text-center font-weight-lighter text-white m-auto col-12 pb-4 pb-sm-0'>
                        Conferences
                    </h1>
                    <span className='h5 text-center font-weight-lighter text-white m-auto col-12'>
                        Passées et à venir
                    </span>
                </FadeInFromBottom>
            </WavyHeader>
            <div className={`bg-light pb-4`}>
                <Container>
                    <ConferenceList/>
                </Container>
            </div>
        </Layout>
    );
};
