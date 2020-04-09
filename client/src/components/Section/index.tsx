import React, { useContext } from 'react';
import { LanguageContext } from '../../contexts';

export interface SectionInterface {
    description: JSX.Element;
}

interface SectionComponentInterface extends SectionInterface {
    page: string;
    section: number;
}

export const Section: React.FC<SectionComponentInterface> = ({description, page, section}) => {
    const { translate } = useContext(LanguageContext);
    return (
        <>
            <div className='text-center d-flex'>
                <h1 className='h1-responsive m-auto title-category'>
                    { translate(`pages.${ page }.section.${ section }.title`) }
                    <div className='dropdown-divider'/>
                </h1>
            </div>
            { description }
        </>
    );
};
