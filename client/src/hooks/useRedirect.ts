import { useHistory } from 'react-router';
import { useEffect } from 'react';

export const useRedirect = (path: string = '', condition: boolean = true) => {
    const { push } = useHistory();
    useEffect(() => {
        if (condition) {
            push(path);
        }
    }, [condition, path, push]);
};
