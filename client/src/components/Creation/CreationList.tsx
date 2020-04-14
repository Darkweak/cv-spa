import React, { useContext, useEffect, useState } from 'react';
import { Creation, CreationInstance } from '../../actions';
import { Loading } from '../Loader';
import { BaseStoreContext, SET_CREATIONS } from '../../contexts/BaseStoreContext';
import { Card } from '../Card';

export const CreationList: React.FC = () => {
    const { creations: baseCreations, dispatch } = useContext(BaseStoreContext);
    const [creations, setCreations] = useState<CreationInstance[]>(baseCreations);
    useEffect(() => {
       if (!baseCreations.length) {
           new Creation().getAll().then(((creations) => {
               setCreations(creations);
               dispatch({
                   payload: creations,
                   type: SET_CREATIONS,
               })
           }));
       }
    }, [baseCreations, dispatch]);

    return (
        <div className='row m-0'>
            {
                creations.length ?
                    creations.map((item, index) => (
                        <div className='col-md-6 p-2' key={ index }>
                            <Card item={{...item, href: item.link}}>
                                <h2 className='font-weight-bolder text-white m-0'>{ item.name }</h2>
                                <span className='d-none pt-0 pt-md-3 d-md-block container'>
                                    {
                                        item.tags.map((i, k) => (
                                            <span key={k} className='px-1'>
                                                <span className='font-weight-bold text-light badge badge-outline-light'>
                                                    { i }
                                                </span>
                                            </span>
                                        ))
                                    }
                                </span>
                            </Card>
                        </div>
                    )) :
                    <Loading text='creations'/>
            }
        </div>
    );
};
