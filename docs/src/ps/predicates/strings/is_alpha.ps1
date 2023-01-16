Build-DocPredicate `
    -Name 'is_alpha' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns if all characters in `$value` is alpha as defined by `IntlChar::isUAlphabetic()`' `
    -Related has_text, has_alpha `
    `
    -Examples @'
```
var_dump(is_alpha('a0eu.1')); //false
var_dump(is_alpha('')); //false
var_dump(is_alpha('    ')); //false
var_dump(is_alpha(' 123  ')); //false
var_dump(is_alpha('aoeuhtns')); //true
```
'@