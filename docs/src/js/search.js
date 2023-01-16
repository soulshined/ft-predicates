export default function (on_match) {
    const filter = document.getElementById('filters');
    const dt_ids = Array.from(document.querySelectorAll('main > dl > dt')).map(e => e.id).sort();

    const input = document.createElement('input');
    input.setAttribute('list', 'dl-dts');
    input.classList.add('form-control', 'input-sm');
    input.setAttribute('aria-label', 'Search input');
    input.setAttribute('placeholder', 'Search');
    input.type = 'search';

    input.onkeyup = e => {
        if (e.key === 'Enter') {
            const { target } = e;
            const value = target.value;
            if (value.length === 0) return;

            if (!dt_ids.includes(value)) {
                target.setCustomValidity("Value doesn't exist");
                target.reportValidity();
                return;
            }

            on_match(value);
        }
    }

    filter.append(input);

    const dl = document.createElement('datalist');
    dl.id = 'dl-dts';

    dt_ids.forEach(e => {
        const opt = document.createElement('option');
        opt.value = e;
        opt.innerText = e.replace(/^[a-zA-Z]+-/, '');
        dl.appendChild(opt);
    });

    filter.appendChild(dl);
}
