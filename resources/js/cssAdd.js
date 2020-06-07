function readyToCheck() {
    if (window.location.pathname != '/home' && window.location.pathname != '/') {
        document.querySelector('header').innerHTML += `
        <link type="text/css" rel="stylesheet" href="
        {{ asset('css/header-normalize.css') }}" media="screen,projection"> `;

        // http://projectapi.pw/css/header-normalize.css

        document.removeEventListener('DOMContentLoaded', readyToCheck);
        document.body.removeChild(document.querySelector('#cssAdd'));
    }
}
document.addEventListener('DOMContentLoaded', readyToCheck);