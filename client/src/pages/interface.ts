import React from 'react';

export type PageType<T = {}> = React.FC<T> & { getInitialProps?: (values?: any) => void; }
