const tags = new Set(Array.from(document.querySelectorAll('li[data-tag]')).map(e => e.getAttribute('data-tag')));

const filter = document.querySelector('#filters > .BtnGroup');

tags.forEach(tag => {
    const button = document.createElement('button');
    button.classList.add('btn');
    button.classList.add('BtnGroup-item');
    button.type = 'button';
    button.innerText = tag;
    button.setAttribute('data-filter', tag);

    filter.appendChild(button);
});

export function clear_filters() {
    document.querySelectorAll('#filters [aria-selected]').forEach(d => d.removeAttribute('aria-selected'));
    document.querySelector('button[data-filter="all"]').setAttribute('aria-selected', 'true');
    document.querySelectorAll('dt,dd').forEach(e => e.classList.remove('filtered'));
}

function filter_by_tag(tag) {
    document.querySelectorAll('dt,dd').forEach(e => e.classList.add('filtered'));
    document.querySelectorAll(`dt > ul.tags li[data-tag="${tag}"]`).forEach(e => {
        const dt = e.closest('dt');
        dt.classList.remove('filtered');

        let nextdt = dt.nextElementSibling;
        while (nextdt !== null) {
            if (nextdt.tagName === 'DT') return;

            nextdt.classList.remove('filtered');
            nextdt = nextdt.nextElementSibling;
        }
    });
}

document.querySelectorAll('#filters button').forEach(btn => btn.addEventListener('click', e => {
    if (e.target.getAttribute('aria-selected')) return;

    document.querySelectorAll('#filters [aria-selected]').forEach(d => d.removeAttribute('aria-selected'));

    e.target.setAttribute('aria-selected', 'true');

    const choice = e.target.getAttribute('data-filter');

    if (choice === 'all') clear_filters();
    else filter_by_tag(choice);
}));
