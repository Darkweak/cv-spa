import { RefObject, useEffect, useState } from 'react';
import { useWindowSize } from './';

export const useVisible = (ref: RefObject<HTMLDivElement>, margin: number = 0) => {
    const {height} = useWindowSize();
    const [isIntersecting, setIntersecting] = useState(false);
    const [current, setCurrent] = useState<any>();
    useEffect(() => {
        setCurrent(ref.current)
    }, [ref]);

    useEffect(() => {
        const observer = new IntersectionObserver(
            ([entry]) => {
                if (entry.isIntersecting)
                    setIntersecting(entry.isIntersecting);
            },
            {
                rootMargin: `${(height ? (height - margin - 1) : 0)}px 0px ${margin}px 0px`
            }
        );
        if (!observer) {
            return;
        }
        if (current) {
            observer.observe(current);
            return () => {
                observer.unobserve(current);
            };
        }
    }, [current, height, margin]);

    return isIntersecting;
};
