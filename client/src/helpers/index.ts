import jwt_decode from 'jwt-decode';
import { ConferenceInstance } from '../actions';

interface InitialStateInterface {
    conferences: {
        conferences: ConferenceInstance[]
    },
    welcome: {
        conferences: ConferenceInstance[]
    },
}

export const hasWindow = (): boolean => 'undefined' !== typeof window;
export const initialState: InitialStateInterface|undefined = (hasWindow() && window['INITIAL_STATE']) || undefined;
export const sprintf = (base: string, replacement: string[]): string => base
    .split('%s')
    .map((s, i) => `${ s }${ replacement[i] || '' }`)
    .join('');

class LS {
    protected hasLS: boolean = 'undefined' !== typeof window;
    protected name = '';

    get(): string {
        return (this.hasLS && localStorage.getItem(this.name)) || '';
    }

    set(value: string): void {
        this.hasLS && localStorage.setItem(this.name, value);
    }

    delete(): void {
        this.hasLS && localStorage.removeItem(this.name);
    }
}

export class Token extends LS {
    protected name = 'token';

    set(value: string): void {
        super.set(value);
        new Username().set(jwt_decode(value));
    }

    getDecoded() {
        return jwt_decode(super.get());
    }
}

export class Language extends LS {
    protected name = 'language';
}

export class Username extends LS {
    protected name = 'username';
}
