import React, { useContext } from 'react';
import './spinner.scss';
import { LanguageContext } from '../../contexts';
import { ClassNameInterface } from '../Layout';

export const Spinner: React.FC = () => (
    <div className='spinner'/>
);

interface LoadingInterface extends ClassNameInterface {
    text?: string;
}
export const Loading: React.FC<LoadingInterface> = ({ className, text }) => {
    const { translate } = useContext(LanguageContext);

    return (
        <div className='py-4 w-100'>
            <div className='w-100 border d-flex rounded'>
                <span className='h4 d-flex m-auto p-3'>
                    <span className='my-auto'>
                        <Spinner/>
                    </span>
                    <span className='pl-2 text-center'>
                        { translate(`loader.${ text || 'default' }`) }
                    </span>
                </span>
            </div>
        </div>
    )
};
