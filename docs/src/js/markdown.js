import { createStarryNight } from 'https://esm.sh/@wooorm/starry-night@1?';
import sourcephp from 'https://esm.sh/@wooorm/starry-night@1.5.0/lang/text.html.php.js';
import { toDom } from 'https://esm.sh/hast-util-to-dom@3?bundle';

[...document.querySelectorAll('.code-caption')].forEach(e => {
    if (e.parentElement.tagName === 'P') {
        e.parentElement.replaceWith(e);
    }
});

(async function apply_syntax_highlighting() {
    const starryNight = await createStarryNight([sourcephp]);

    const nodes = Array.from(document.body.querySelectorAll('pre > code'));

    for (const node of nodes) {
        const tree = starryNight.highlight(`<?php${node.textContent}`, 'text.html.php');

        tree.children.shift();

        node.replaceChildren(toDom(tree, { fragment: true }))
    }
})();

