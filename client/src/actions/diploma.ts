import { Career, CareerInstance, CareerInterface } from './Career';

interface DiplomaInterface extends CareerInterface {
    obtainedAt: string;
}

export class DiplomaInstance extends CareerInstance {
    constructor(job: DiplomaInterface) {
        super(job);
        this.leavedAt = new Date(job.obtainedAt);
    }
}

export class Diploma extends Career {
    public endpoint = '/diplomas';
    public model = item => new DiplomaInstance(item);

    getAll(): Promise<DiplomaInstance[]> {
        return super.getAll() as Promise<DiplomaInstance[]>
    }
}
