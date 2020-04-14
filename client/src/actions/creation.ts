import { AbstractModel, API } from './API';

interface CreationInterface {
    '@id': string;
    tags: {name: string}[];
    name: string;
    description: string;
    image: string;
    link: string;
}

export class CreationInstance extends AbstractModel {
    public tags: string[];
    public name: string;
    public description: string;
    public image: string;
    public link: string;

    constructor(creation: CreationInterface) {
        super(creation);
        this.tags = creation.tags.map(({ name }) => name);
        this.name = creation.name;
        this.description = creation.description;
        this.image = creation.image;
        this.link = creation.link;
    }
}

export class Creation extends API {
    public endpoint = '/sites';

    getAll(): Promise<CreationInstance[]> {
        return this.getMany().then((data: CreationInterface[]) => {
            return data.map(item => new CreationInstance(item));
        })
    }
};
