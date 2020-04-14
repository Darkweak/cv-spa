import { useCallback, useEffect, useState } from 'react';
import { getWindow, hasWindow } from '../helpers';

export const useWindowSize = () => {
    const getSize = useCallback(() => ({
        width: getWindow()?.innerWidth,
        height: getWindow()?.innerHeight
    }), []);

    const [windowSize, setWindowSize] = useState(getSize);

    useEffect(() => {
        if (!hasWindow()) {
            return;
        }

        function handleResize() {
            setWindowSize(getSize());
        }

        window.addEventListener('resize', handleResize);
        return () => window.removeEventListener('resize', handleResize);
    }, [getSize]);

    return windowSize;
}
