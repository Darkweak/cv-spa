import React from 'react';
import { ClassNameInterface } from './index';

export interface IconInterface extends ClassNameInterface {
    icon: string;
    type?: 'fab' | 'far' | 'fal';
}

export const Icon: React.FC<IconInterface> = ({className, icon, type}) => (
    <i className={`${type || 'fas'} fa-${icon} my-auto${ className ? ` ${ className }` : '' }`}/>
);
