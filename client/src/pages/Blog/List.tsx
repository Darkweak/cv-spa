import React, { useContext } from 'react';
import { WavyHeader } from '../../components/Wave';
import { FadeInFromBottom } from '../../components/Visible';
import { Layout } from '../../components/Layout';
import { Container } from 'react-bootstrap';
import { BlogList as List } from '../../components/Blog';
import { LanguageContext } from '../../contexts';
import { Article } from '../../actions';
import { PageType } from '../interface';

export const BlogList: PageType = () => {
    const { translate } = useContext(LanguageContext);
    return (
        <Layout title='pages.article.list.title'>
            <WavyHeader>
                <FadeInFromBottom className='mx-auto text-uppercase'>
                    <h1 className='text-center font-weight-lighter text-white m-auto col-12 pb-4 pb-sm-0'>
                        {translate('pages.article.wave.title')}
                    </h1>
                    <span className='h5 text-center font-weight-lighter text-white m-auto col-12'>
                        {translate('pages.article.wave.subtitle')}
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

BlogList.getInitialProps = () => {
    return [
        new Article().getAll().then(articles => ({
            blogList: {
                articles
            }
        })),
    ];
};

export default BlogList;
