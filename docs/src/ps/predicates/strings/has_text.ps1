Build-DocPredicate `
    -Name 'has_text' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if there are any non-whitespace characters in `$value`' `
    -Related has_alpha, has_digit, has_punctuation, has_whitespace `
    `
    -Examples @'
```
var_dump(has_text('a0eu.1')); //true
var_dump(has_text('')); //false
var_dump(has_text('    ')); //false
var_dump(has_text(' 123  ')); //true
```
'@