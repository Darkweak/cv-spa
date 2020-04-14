import React, { useContext, useEffect, useState } from 'react';
import { Layout } from '../components/Layout';
import { WavyHeader } from '../components/Wave';
import { FadeInFromBottom } from '../components/Visible';
import { LanguageContext } from '../contexts';
import { PageType } from './interface';
import { Category, CategoryInstance } from '../actions/category';
import { BaseStoreContext, SET_CATEGORIES } from '../contexts/BaseStoreContext';
import { CustomLink } from '../components/CustomLink';
import { Container } from 'react-bootstrap';
import { Loading } from '../components/Loader';

export const Skills: PageType = () => {
    const {translate} = useContext(LanguageContext);
    const { categories: baseCategories, dispatch } = useContext(BaseStoreContext);
    const [categories, setCategories] = useState<CategoryInstance[]>(baseCategories || []);
    useEffect(() => {
        if (!baseCategories.length) {
            new Category()
                .getAll()
                .then(categories => {
                    setCategories(categories);
                    dispatch({
                        payload: categories,
                        type: SET_CATEGORIES,
                    })
                });
        }
    }, [baseCategories, dispatch]);

    return (
        <Layout title='pages.skills.title'>
            <WavyHeader>
                <FadeInFromBottom className='mx-auto text-uppercase'>
                    <h1 className='text-center font-weight-lighter text-white m-auto col-12 pb-4 pb-sm-0'>
                        {translate('pages.skills.wave.title')}
                    </h1>
                    <span className='h5 text-center font-weight-lighter text-white m-auto col-12'>
                        {translate('pages.skills.wave.subtitle')}
                    </span>
                </FadeInFromBottom>
            </WavyHeader>
            <div className={`bg-light pb-4`}>
                <Container>
                    {
                        categories.length ?
                            categories.map((category, index) => (
                                <div className="pb-5" key={index}>
                                    <div className="bg-secondary p-4 position-relative">
                                        <h2 className="middle-line text-white text-center m-0">
                                            { category.name }
                                        </h2>
                                    </div>
                                    <div className="row m-0 b-e-t-secondary">
                                        {
                                            category.competences
                                                .map((competence, key) => (
                                                    <div className="col-xs-12 col-sm-6 col-lg-4 btop-secondary p-3 d-flex">
                                                        <CustomLink
                                                            href={ competence.link }
                                                            className="text-decoration-none text-muted text-center m-auto">
                                                            <span className='h4 m-0'>{ competence.name }</span>
                                                        </CustomLink>
                                                    </div>
                                                ))
                                        }
                                    </div>
                                </div>
                            )) :
                            <Loading text='skills'/>
                    }
                </Container>
            </div>
        </Layout>
    )
};

Skills.getInitialProps = () => {
    return [
        new Category()
            .getAll()
            .then(categories => ({
                categories: {
                    categories
                }
            }))
    ];
};

export default Skills;
