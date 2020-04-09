import React from 'react';
import { Icon } from '../Layout';
import { ConferenceInstance } from '../../actions';
import { Loading } from '../Loader';
import { Link } from '../CustomLink';

interface ConferenceItemInterface {
    conference?: ConferenceInstance;
}

export const ConferenceItem: React.FC<ConferenceItemInterface> = ({ conference }) => (
    <div className='row m-0'>
        {
            !conference ?
                <div className='py-4 w-100'>
                    <Loading text={`conference.item`}/>
                </div> :
                <>
                    <div className='col-sm-4'>
                        <div className='flex-column sticky-top py-5 z-1'>
                            <p>{conference.name}</p>
                            <p>{conference.code}, {conference.city}</p>
                            <p>{conference.street}</p>
                            <p>
                                <a href={conference.link} target='_blank' rel='noopener noreferrer' className='text-muted text-decoration-none'>
                                    Lien vers les places
                                </a>
                            </p>
                            <p>
                                <Link to='/conferences' className='text-muted text-decoration-none'>
                                    <Icon icon='arrow-circle-left'/> Retour aux conférences
                                </Link>
                            </p>
                        </div>
                    </div>
                    <div className='col-sm-8 text-underline'>
                        <h2 className='pb-2'>
                            Résumé de la conférence :
                        </h2>
                        {
                            conference.abstract.split('\n').map((item, index) => (
                                <span className='fs-3 d-block' key={ index }>
                                        { item }
                                    </span>
                            ))
                        }
                    </div>
                </>
        }
    </div>
);
