import './markdown.min.js';
import search from './search.min.js';
import { clear_filters } from './filter.min.js';
import './toc.min.js';

search(value => {
    clear_filters();

    window.location = `#${value}`;
})

const toc = document.getElementById('toc');
toc.toggleAttribute('hidden');

window.addEventListener('hashchange', navigateToHash);
window.addEventListener('click', e => {
    if (!e.target || e.target.tagName !== "A") return;
    if (!e.target.hash || !e.target.hash.startsWith('#')) return;

    e.preventDefault();

    if (toc.contains(e.target)) toc.removeAttribute('open');

    const elem = document.getElementById(e.target.hash.substring(1));

    window.scrollTo({
        top: elem.offsetTop - 25,
        behavior : 'smooth'
    })
})

function navigateToHash() {
    const elem = document.getElementById(location.hash.substring(1));
    if (!elem) return;

    toc.removeAttribute('open');

    window.scroll({
        top: elem.offsetTop - 25,
        behavior: 'smooth'
    })
}

if (location.hash) navigateToHash();