import { AbstractModel, API } from './API';

interface CategoryInterface {
    '@id': string;
    competences: {name: string, link: string}[];
    name: string;
}

export class CategoryInstance extends AbstractModel {
    public competences: {name: string, link: string}[];
    public name: string;

    constructor(category: CategoryInterface) {
        super(category);
        this.competences = category.competences;
        this.name = category.name;
    }
}

export class Category extends API {
    public endpoint = '/categories';

    getAll(): Promise<CategoryInstance[]> {
        return this.getMany().then((data: CategoryInterface[]) => {
            return data.map(item => new CategoryInstance(item));
        })
    }
};
