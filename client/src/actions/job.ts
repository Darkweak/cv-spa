import { Career, CareerInstance, CareerInterface } from './Career';

interface JobInterface extends CareerInterface {
    isValid: boolean;
    leavedAt: string;
    referent: string;
}

export class JobInstance extends CareerInstance {
    public isValid: boolean;
    public referent: string;

    constructor(job: JobInterface) {
        super(job);
        this.isValid = job.isValid;
        this.leavedAt = job.leavedAt ? new Date(job.leavedAt) : undefined;
        this.referent = job.referent;
    }
}

export class Job extends Career {
    public endpoint = '/jobs';
    public model = item => new JobInstance(item);

    getAll(): Promise<JobInstance[]> {
        return super.getAll() as Promise<JobInstance[]>
    }
}
