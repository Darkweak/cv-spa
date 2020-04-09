import { AbstractModel, API } from './API';

type Locale = 'en'|'fr';

interface CodeInterface {
    content: string;
    name: string;
}

interface CodePackageInterface {
    codes: CodeInterface[]
}

interface TranslationInterface {
    en: {
        locale: Locale;
        [key: string]: string;
    },
    fr: {
        locale: Locale;
        [key: string]: string;
    }
}

interface TextInterface {
    translations: TranslationInterface
}

interface ArticleInterface {
    '@id': string;
    codePackages: CodePackageInterface[];
    image: string;
    texts: TextInterface[];
    translations: TranslationInterface;
}

export class ArticleInstance extends AbstractModel {
    public codePackages: CodePackageInterface[];
    public image: string;
    public texts: TextInterface[];
    public translations: TranslationInterface;

    constructor(article: ArticleInterface) {
        super(article);
        this.codePackages = article.codePackages;
        this.image = article.image;
        this.texts = article.texts;
        this.translations = article.translations;
    }
}

export class Article extends API {
    public endpoint = '/articles';

    public async get({ id }: { id: string }) {
        this.endpoint = '/article';
        return this.getOne({ endpoint: `/${ id }` }).then(({ data }) => new ArticleInstance(data))
    }

    getAll(): Promise<ArticleInstance[]> {
        return this.getMany().then((data: ArticleInterface[]) => {
            return data.map(item => new ArticleInstance(item));
        })
    }
}
