import React, { useContext } from 'react';
import { Icon, Layout } from '../components/Layout';
import { WavyHeader } from '../components/Wave';
import { LightPilledButton } from '../components/Button';
import { Container } from 'react-bootstrap';
import { Section, SectionInterface } from '../components/Section';
import { FadeInFromBottom } from '../components/Visible';
import { CustomLink, Link } from '../components/CustomLink';
import { ConferenceList } from '../components/Conference';
import { LanguageContext } from '../contexts';
import { PageType } from './interface';
import { Conference } from '../actions';

const getDescriptions = (translate: (value: string) => string): SectionInterface[] => {
    const t = (s: string, v: string): string => translate(`pages.home.section.${s}.descriptions.${v}`)

    return [
        {
            description: (
                <h5 className='h5-responsive m-0'>
                    {t('0', '0')} <CustomLink
                    href='https://les-tilleuls.coop'>
                    les-tilleuls.coop
                </CustomLink>, {t('0', '1')}.
                </h5>
            ),
        },
        {
            description: (
                <h5 className='h5-responsive m-0'>
                    {t('1', '0')} <CustomLink href='https://github.com/darkweak/Souin'>
                    Souin</CustomLink>. {t('1', '1')} <CustomLink href='https://marketplace.devcv.fr'>
                    {t('1', '2')}
                </CustomLink>. {t('1', '3')} : <CustomLink href='https://github.com/darkweak/Marketplace'>
                    Marketplace</CustomLink>. {t('1', '4')}.
                </h5>
            ),
        },
        {
            description: (
                <>
                    <ConferenceList conferenceContext='welcome' loadingText={'last'} max={2} perRow={2}/>
                    <div className='d-flex p-2'>
                        <Link to='/conferences' className='ml-auto text-black-50 text-decoration-none'>
                            {t('2', '0')} <Icon icon='arrow-circle-right'/>
                        </Link>
                    </div>
                </>
            ),
        },
    ]
};

export const Welcome: PageType = () => {
    const {translate} = useContext(LanguageContext);
    return (
        <Layout>
            <WavyHeader>
                <FadeInFromBottom className='mx-auto text-uppercase'>
                    <span className='h1 text-center font-weight-lighter text-white m-auto col-12 pb-4 pb-sm-0'>
                        {translate('pages.home.wave.title')}
                    </span>
                    <span className='h5 text-center font-weight-lighter text-white m-auto col-12'>
                        {translate('pages.home.wave.subtitle')}
                    </span>
                    <div className='w-100 pt-5 text-center'>
                        <a
                            href={`${ process.env.REACT_APP_API_ENTRYPOINT }/cv`}
                            rel="noopener noreferrer"
                            target='_blank'>
                            <LightPilledButton outlined>
                                <span className='fs-3 text-center font-weight-lighter p-2'>
                                    <Icon icon='download'/> {translate('pages.home.wave.download')}
                                </span>
                            </LightPilledButton>
                        </a>
                    </div>
                </FadeInFromBottom>
            </WavyHeader>
            {
                getDescriptions(translate).map((description, index) => (
                    <div key={index} className={`text-justify bg-light ${index > 0 && 'py-5'}`}>
                        <FadeInFromBottom>
                            <Container>
                                <Section {...description} section={index} page='home'/>
                            </Container>
                        </FadeInFromBottom>
                    </div>
                ))
            }
        </Layout>
    )
};

Welcome.getInitialProps = () => {
    return [
        new Conference({filters: {perPage: (2).toString()}})
            .getAll()
            .then(conferences => ({
                welcome: {
                    conferences
                }
            }))
    ];
};

export default Welcome;
