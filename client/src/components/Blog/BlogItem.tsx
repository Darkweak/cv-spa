import React, { useContext } from 'react';
import { ArticleInstance } from '../../actions';
import { Loading } from '../Loader';
import { LanguageContext } from '../../contexts';
import Highlight from 'react-highlight.js';
import { FadeInFromBottom } from '../Visible';

interface ConferenceItemInterface {
    article?: ArticleInstance
}

export const BlogItem: React.FC<ConferenceItemInterface> = ({ article }) => {
    const { language } = useContext(LanguageContext);
    return (
        <>
            {
                !article ?
                    <div className='py-4 w-100'>
                        <Loading text={`article.item`}/>
                    </div> :
                    <div className="col-12">
                        {
                            article?.texts.map((text, index: number) => (
                                <div className='py-2' key={index}>
                                    <FadeInFromBottom>
                                        <div dangerouslySetInnerHTML={{
                                            __html: text.translations[language].description
                                        }}/>
                                    </FadeInFromBottom>
                                    {
                                        article?.codePackages[index]?.codes.map((code, key) => (
                                            <FadeInFromBottom key={key}>
                                                <div className='py-2'>
                                                    <Highlight language={code.name}>
                                                        {code.content}
                                                    </Highlight>
                                                </div>
                                            </FadeInFromBottom>
                                        ))
                                    }
                                </div>
                            ))
                        }
                    </div>
            }
        </>
    )
};
