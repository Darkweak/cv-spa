import axios, { AxiosInstance, AxiosRequestConfig, AxiosResponse } from 'axios';

export abstract class AbstractModel {
    public '@id': string;
    public id: string;
    public name: string = '';

    protected constructor(object: any) {
        this['@id'] = object['@id'];
        this.id = object['@id'].split('/')[2];
    }
}

interface EndpointInterface {
    endpoint?: string
}

interface APIConstructorInterface {
    filters?: { [key: string]: string };
    pagination?: { [key: string]: string };
}

export abstract class API {
    protected endpoint = '';
    protected filters = {};
    protected pagination = {};

    constructor({ filters, pagination }: APIConstructorInterface = {}) {
        this.filters = filters || {};
        this.pagination = pagination || {};
    }

    formatQueryParameters = (): string => {
        const queryParametersObject = Object.entries({
            ...this.pagination,
            ...this.filters
        }).reduce(
            (a, [k, v]: [string, any /*eslint-disable-line*/]) =>
                v || v === false
                    ? Array.isArray(v) && v.length
                    ? {
                        ...a,
                        [k]: `[${
                            v[0].value
                                ? v.map(x => x.value).join(',')
                                : v.join(',')
                        }]`
                    }
                    : v.value || v.value === false
                        ? { ...a, [k]: v.value }
                        : v.length
                            ? { ...a, [k]: v }
                            : a
                    : a,
            {}
        );

        return Object.keys(queryParametersObject).length
            ? `?${new URLSearchParams(queryParametersObject).toString()}`
            : '';
    };


    getRequest(): AxiosInstance {
        return axios.create({
            baseURL: `${process.env.REACT_APP_API_ENTRYPOINT}`,
            headers: {
                'Content-Type': 'application/ld+json',
                Accept: 'application/ld+json'
            },
        })
    }

    async getOne({endpoint = ''}: EndpointInterface = {}): Promise<AxiosResponse> {
        return this.getRequest().get(`${this.endpoint}${ endpoint }`);
    }

    async getMany(): Promise<any[]> {
        return this
            .getRequest()
            .get(`${this.endpoint}${this.formatQueryParameters()}`)
            .then(({ data }) => data['hydra:member']);
    };

    async post({ data }: AxiosRequestConfig & EndpointInterface): Promise<AxiosResponse> {
        return this.getRequest().post(this.endpoint, data);
    };

    async patch({endpoint = '', data}: AxiosRequestConfig & EndpointInterface): Promise<AxiosResponse> {
        return this.getRequest().patch(this.endpoint, data);
    };
}
