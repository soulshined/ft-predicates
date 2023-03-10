const menu_targets = [
    {
        category: 'predicate',
        toc_elem: document.getElementById('toc-predicates-sections')
    },
    {
        category: 'constant',
        toc_elem: document.getElementById('toc-constants-sections')
    }
];

menu_targets.forEach(e => {
    document.querySelectorAll(`h3[data-${e.category}-category]`).forEach(h3 => {
        const cat = h3.getAttribute(`data-${e.category}-category`);
        const dt_ids = [...document.querySelectorAll(`dl[data-${e.category}-category="${cat}"] > dt`)].map(p => p.id);
        const resultList = new TagBuilder('div').classes('SelectMenu-list');

        dt_ids.forEach(p => {
            const text = p.replace(/^[a-zA-Z]+-/, '');

            resultList.append(
                new TagBuilder('li')
                    .attr('role', 'menuitem')
                    .append(
                        new AnchorBuilder(`#${p}`).innerText(text).classes('Link--secondary')
                            .classes('SelectMenu-item')
                    )
                    .build()
            );
        })

        const li = new TagBuilder('li').classes('dropdown-item').append(
            new TagBuilder('details')
                .classes('details-overlay', 'details-reset', 'dropdown-item')
                .append(
                    new TagBuilder('summary').innerText(cat),
                    new TagBuilder('div').classes('SelectMenu').append(
                        new TagBuilder('div').classes('SelectMenu-modal').append(
                            resultList
                        )
                    )
                )
        );

        e.toc_elem.appendChild(li.build());
    })
})