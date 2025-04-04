import {registerBlockType} from '@wordpress/blocks';

import data from './block.json';
import Edit from "./edit";

const icon = <svg fill="none" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m12 1.25c-5.93706 0-10.75 4.81294-10.75 10.75 0 5.9371 4.81294 10.75 10.75 10.75 5.9371 0 10.75-4.8129 10.75-10.75 0-5.93706-4.8129-10.75-10.75-10.75z" fill="#4caf50"/><path clipRule="evenodd" d="m22.75 12h-21.5c0 5.9371 4.81294 10.75 10.75 10.75 5.9371 0 10.75-4.8129 10.75-10.75z" fill="#39943c" fillRule="evenodd"/><path d="m9.8975 6.364c-.2312-.1445-.52261-.15215-.76108-.01998-.23846.13217-.38642.38334-.38642.65598v10c0 .2726.14796.5238.38642.656.23847.1322.52988.1245.76108-.02l8-5c.2193-.1371.3525-.3774.3525-.636s-.1332-.4989-.3525-.636z" fill="#fafafa"/><path clip-rule="evenodd" d="m18.25 12h-9.5v5c0 .2726.14796.5238.38642.656.23847.1322.52988.1245.76108-.02l8-5c.2193-.1371.3525-.3774.3525-.636z" fill="#e5e6e8" fillRule="evenodd"/></svg>

registerBlockType('radio-player/radio-player', {
    ...data,
    icon,
    edit: Edit,
});