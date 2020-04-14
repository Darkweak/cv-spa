import React, { useContext, useEffect, useState } from 'react';
import { Layout } from '../components/Layout';
import { WavyHeader } from '../components/Wave';
import { FadeInFromBottom } from '../components/Visible';
import { LanguageContext } from '../contexts';
import { PageType } from './interface';
import { BaseStoreContext, SET_DIPLOMAS, SET_JOBS } from '../contexts/BaseStoreContext';
import './scss/career.scss';
import { Diploma, DiplomaInstance } from '../actions/diploma';
import { Job, JobInstance } from '../actions/job';
import { CareerInstance } from '../actions/Career';
import { Loading } from '../components/Loader';
import { sprintf } from '../helpers';

interface CareerItemInterface {
    items: CareerInstance[];
    title: string;
    type?: string;
}

const CareerItem: React.FC<CareerItemInterface> = ({
    items,
    title,
    type = 'primary',
}) => {
    const { translate } = useContext(LanguageContext);
    const t = (v: string) => translate(`pages.career.${ v }`);
    return (
        <div className="col-md-6">
            <div className={`bs-bg-${ type || 'primary' } p-4 text-center`}>
                <h2 className="middle-line text-white text-center m-0">
                    { t(title) }
                </h2>
            </div>
            {
                items.length ?
                    items.map((item, key) => (
                        <div
                            className={`bs-alert bs-alert-${ type || 'primary' } p-3 text-center mb-2`}
                            key={key}>
                            <h3>{ item.name }</h3>
                            <div className="py-3">
                                <h4>{ item.institute }</h4>
                                <span className="d-block">{`${ item.cp } ${ item.city }`}</span>
                            </div>
                            <span>
                                { sprintf(t(item.leavedAt ? 'fromTo' : 'fromToToday'), [item.startedAt.toLocaleDateString(), item.leavedAt?.toLocaleDateString() || '']) }
                            </span>
                        </div>
                    )) :
                    <Loading text={`career.${ title }`}/>
            }
        </div>
    )
};

export const Career: PageType = () => {
    const {translate} = useContext(LanguageContext);
    const t = (v: string) => translate(`pages.career.${ v }`);
    const { diplomas: baseDiplomas, jobs: baseJobs, dispatch } = useContext(BaseStoreContext);
    const [diplomas, setDiplomas] = useState<DiplomaInstance[]>(baseDiplomas);
    const [jobs, setJobs] = useState<JobInstance[]>(baseJobs);
    useEffect(() => {
        if (!baseDiplomas.length) {
            new Diploma()
                .getAll()
                .then(diplomas => {
                    setDiplomas(diplomas);
                    dispatch({
                        payload: diplomas,
                        type: SET_DIPLOMAS,
                    })
                });
        }
    }, [baseDiplomas, dispatch]);
    useEffect(() => {
        if (!baseJobs.length) {
            new Job()
                .getAll()
                .then(jobs => {
                    setJobs(jobs);
                    dispatch({
                        payload: jobs,
                        type: SET_JOBS,
                    })
                });
        }
    }, [baseJobs, dispatch]);

    return (
        <Layout title='pages.career.title'>
            <WavyHeader>
                <FadeInFromBottom className='mx-auto text-uppercase'>
                    <h1 className='text-center font-weight-lighter text-white m-auto col-12 pb-4 pb-sm-0'>
                        {t('wave.title')}
                    </h1>
                    <span className='h5 text-center font-weight-lighter text-white m-auto col-12'>
                        {t('wave.subtitle')}
                    </span>
                </FadeInFromBottom>
            </WavyHeader>
            <div className='bg-light pb-4'>
                <div className='container'>
                    <div className='row m-0'>
                        <CareerItem title='jobs' items={jobs}/>
                        <CareerItem title='diplomas' items={diplomas} type='success'/>
                    </div>
                </div>
            </div>
        </Layout>
    )
};

Career.getInitialProps = () => {
    return [
        new Diploma()
            .getAll()
            .then(diplomas => diplomas),
        new Job()
            .getAll()
            .then(jobs => jobs),
    ];
};

export default Career;
