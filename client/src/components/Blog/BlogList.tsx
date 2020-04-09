import React, { useContext, useEffect, useState } from 'react';
import { Article, ArticleInstance } from '../../actions';
import { Link } from '../CustomLink';
import { Loading } from '../Loader';
import { LanguageContext } from '../../contexts';
import { BaseStoreContext, SET_ARTICLES } from '../../contexts/BaseStoreContext';

const BlogListItem = ({ item }: { item: ArticleInstance }) => {
    const { language } = useContext(LanguageContext);
    return (
        <Link
            to={`/blog/${ item.translations[language].slug }`}
            className='card text-white conference-card'>
            <img loading="lazy" className='card-img img-fit' src={ item.image } alt={ item.image }/>
            <div className='card-img-overlay d-flex transition pointer'>
                <div className='m-auto text-center transition'>
                    <h2 className='d-block card-title fs-3 m-0 font-weight-bolder'>
                        { item.translations[language].title }
                    </h2>
                </div>
            </div>
        </Link>
    )
};

export const BlogList: React.FC = () => {
    const { articles: baseArticles, dispatch } = useContext(BaseStoreContext);
    const [articles, setArticles] = useState<ArticleInstance[]>(baseArticles);
    useEffect(() => {
        new Article().getAll().then(((articles) => {
            setArticles(articles);
            dispatch({
                payload: articles,
                type: SET_ARTICLES,
            })
        }));
    }, [dispatch]);

    return (
        <div className='row m-0'>
            {
                !articles.length ?
                    <div className='py-4 w-100'>
                        <Loading text='article.list.default'/>
                    </div> :
                    articles.map((article, index) => (
                        <div className='col-md-6 p-2' key={ index }>
                            <BlogListItem item={ article }/>
                        </div>
                    ))

            }
        </div>
    );
};
