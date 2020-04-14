import React, { useContext, useEffect, useState } from 'react';
import { Article, ArticleInstance } from '../../actions';
import { Loading } from '../Loader';
import { LanguageContext } from '../../contexts';
import { BaseStoreContext, SET_ARTICLES } from '../../contexts/BaseStoreContext';
import { Card } from '../Card';

const BlogListItem = ({ item }: { item: ArticleInstance }) => {
    const { language } = useContext(LanguageContext);
    return (
        <Card item={{...item, to: `/blog/${ item.translations[language].slug }`}}>
          <h2 className='d-block card-title fs-3 m-0 font-weight-bolder'>
              { item.translations[language].title }
          </h2>
        </Card>
    )
};

export const BlogList: React.FC = () => {
    const { articles: baseArticles, dispatch } = useContext(BaseStoreContext);
    const [articles, setArticles] = useState<ArticleInstance[]>(baseArticles);
    useEffect(() => {
       if (!baseArticles.length) {
           new Article().getAll().then(((articles) => {
               setArticles(articles);
               dispatch({
                   payload: articles,
                   type: SET_ARTICLES,
               })
           }));
       }
    }, [baseArticles, dispatch]);

    return (
        <div className='row m-0'>
            {
                articles.length ?
                    articles.map((article, index) => (
                        <div className='col-md-6 p-2' key={ index }>
                            <BlogListItem item={ article }/>
                        </div>
                    )) :
                    <Loading text='article.list.default'/>
            }
        </div>
    );
};
