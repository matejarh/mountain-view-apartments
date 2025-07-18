import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// window.axios.defaults.headers.common['Content-Security-Policy'] = "default-src 'self'; frame-ancestors 'none'";

import favicon from '../images/favicon.svg'

const setFavicon = () => {
    let link = document.querySelector("link[rel*='icon']") || document.createElement('link');
    // link.type = 'image/png';
    link.type = 'image/svg+xml';
    link.rel = 'shortcut icon';
    link.href = favicon;
    document.getElementsByTagName('head')[0].appendChild(link);
}

setFavicon()
