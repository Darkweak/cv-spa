import { AbstractModel, API } from './API';

interface ConferenceInterface {
    '@id': string;
    abstract: string;
    city: string;
    cp: string;
    date: string;
    image: string;
    link: string;
    name: string;
    street: string;
}

export class ConferenceInstance extends AbstractModel {
    public abstract: string;
    public city: string;
    public code: string;
    public date: string;
    public image: string;
    public link: string;
    public street: string;
    public to: string;

    constructor(conference: ConferenceInterface) {
        super(conference);
        this.abstract = conference.abstract;
        this.city = conference.city;
        this.code = conference.cp;
        this.date = conference.date;
        this.image = conference.image;
        this.link = conference.link;
        this.name = conference.name;
        this.street = conference.street;
        this.to = `/conferences/${ [
            this.city.toLowerCase(),
            conference.date.split('T')[0],
        ].join('-') }`;
    }
}

export class Conference extends API {
    public endpoint = '/conferences';

    public async get({ id }: { id: string }) {
        this.endpoint = '/conference';
        return this.getOne({ endpoint: `/${ id }` }).then(({ data }) => new ConferenceInstance(data))
    }

    getAll(): Promise<ConferenceInstance[]> {
        return this.getMany().then((data: ConferenceInterface[]) => {
            return data.map(item => new ConferenceInstance(item));
        })
    }
};
