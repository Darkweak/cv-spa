import React, { useContext } from 'react';
import { WavyHeader } from '../../components/Wave';
import { FadeInFromBottom } from '../../components/Visible';
import { Layout } from '../../components/Layout';
import { Container } from 'react-bootstrap';
import { LanguageContext } from '../../contexts';
import { Creation } from '../../actions';
import { PageType } from '../interface';
import { CreationList as List } from '../../components/Creation';

export const CreationList: PageType = () => {
    const { translate } = useContext(LanguageContext);
    return (
        <Layout title='pages.creations.list.title'>
            <WavyHeader>
                <FadeInFromBottom className='mx-auto text-uppercase'>
                    <h1 className='text-center font-weight-lighter text-white m-auto col-12 pb-4 pb-sm-0'>
                        {translate('pages.creations.wave.title')}
                    </h1>
                    <span className='h5 text-center font-weight-lighter text-white m-auto col-12'>
                        {translate('pages.creations.wave.subtitle')}
                    </span>
                </FadeInFromBottom>
            </WavyHeader>
            <div className={`bg-light pb-4`}>
                <Container>
                    <List/>
                </Container>
            </div>
        </Layout>
    );
};

CreationList.getInitialProps = () => {
    return [
        new Creation()
            .getAll()
            .then(creations => ({
                creations: {
                    creations
                }
            }))
    ];
};

export default CreationList;
