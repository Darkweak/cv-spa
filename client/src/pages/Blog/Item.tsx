import React, { useContext, useEffect, useState } from 'react';
import { WavyHeader } from '../../components/Wave';
import { FadeInFromBottom } from '../../components/Visible';
import { Layout } from '../../components/Layout';
import { useParams } from 'react-router-dom';
import { BlogItem as Item } from '../../components/Blog';
import { Container } from 'react-bootstrap';
import { Article, ArticleInstance } from '../../actions';
import { LanguageContext } from '../../contexts';
import { BaseStoreContext, SET_ARTICLE } from '../../contexts/BaseStoreContext';
import { PageType } from '../interface';

export const BlogItem: PageType = () => {
    const { slug } = useParams();
    const { language, translate } = useContext(LanguageContext);
    const { article: { [`${ slug }`]: baseArticle }, dispatch } = useContext(BaseStoreContext);
    const [article, setArticle] = useState<ArticleInstance|undefined>(baseArticle);
    useEffect(() => {
        if (!baseArticle) {
            new Article().get({ id: `${ slug }` }).then((article) => {
                setArticle(article);
                dispatch({
                    payload: {
                        key: article.translations[language].slug,
                        value: article,
                    },
                    type: SET_ARTICLE,
                })
            });
        }
    }, [dispatch, language, slug]);
    const title = article?.translations[language].title || '';
    const t = translate('loader.article.item');
    return (
        <Layout title={title}>
            <WavyHeader>
                { article ?
                  <FadeInFromBottom className='mx-auto text-uppercase container'>
                    <h1 className='text-center font-weight-lighter text-white m-auto col-12 pb-4 pb-sm-0'>
                        { article ? title : t }
                    </h1>
                  </FadeInFromBottom> :
                    <h1 className='text-center font-weight-lighter text-white m-auto col-12 pb-4 pb-sm-0'>
                        { t }
                    </h1>
                }
            </WavyHeader>
            <div className={`bg-light pb-4`}>
                <Container>
                    <Item article={article}/>
                </Container>
            </div>
        </Layout>
    );
};

BlogItem.getInitialProps = ([,language, , slug]: [string, string, string, string]) => {
    return [
        new Article().get({ id: slug })
            .then(article => ({
                blogItem: {
                    [article.translations[language].slug]: encodeURIComponent(JSON.stringify(article))
                }
            }))
            .catch(() => {}),
    ];
};
