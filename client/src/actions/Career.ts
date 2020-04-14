import { AbstractModel, API } from './API';

export interface CareerInterface {
    '@id': string;
    startedAt: string;
    institute: string;
    name: string;
    city: string;
    cp: string;
}

export abstract class CareerInstance extends AbstractModel {
    public startedAt: Date;
    public leavedAt?: Date;
    public institute: string;
    public city: string;
    public cp: string;

    constructor(career: CareerInterface) {
        super(career);
        this.cp = career.cp;
        this.city = career.city;
        this.institute = career.institute;
        this.name = career.name;
        this.startedAt = new Date(career.startedAt);
    }
}

export class Career extends API {
    public model;

    getAll(): Promise<CareerInstance[]> {
        return this.getMany().then((data: CareerInterface[]) => {
            return data.map(this.model);
        })
    }
}
