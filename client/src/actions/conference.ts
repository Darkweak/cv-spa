import { AbstractModel, API } from './API';

interface ConferenceInterface {
    '@id': string;
    abstract: string;
    image: string;
    date: string;
    link: string;
    name: string;
    city: string;
    street: string;
}

export class ConferenceInstance extends AbstractModel {
    public abstract: string;
    public city: string;
    public date: Date;
    public image: string;
    public link: string;
    public street: string;

    constructor(conference: ConferenceInterface) {
        super(conference);
        this.abstract = conference.abstract;
        this.city = conference.city;
        this.date = new Date(conference.date);
        this.image = conference.image;
        this.link = conference.link;
        this.name = conference.name;
        this.street = conference.street;
    }
}

export class Conference extends API {
    public endpoint = '/conferences';

    public async get({ id }: { id: string }) {
        return this.getOne({ endpoint: `/${ id }` }).then(({ data }) => new ConferenceInstance(data))
    }

    getAll(): Promise<ConferenceInstance[]> {
        return this.getMany().then((data: ConferenceInterface[]) => {
            return data.map(item => new ConferenceInstance(item));
        })
    }
};
