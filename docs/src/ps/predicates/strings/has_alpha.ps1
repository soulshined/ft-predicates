Build-DocPredicate `
    -Name 'has_alpha' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if any character in `$value` is alpha as defined by `IntlChar::isUAlphabetic()`' `
    -Related has_text, is_alpha `
    `
    -Examples @'
```
var_dump(has_alpha('   aoeuhtns12  3')); //true
var_dump(has_alpha('a0eu.1')); //true
var_dump(has_alpha('a!@#$eu   ')); //true
var_dump(has_alpha('')); //false
var_dump(has_alpha('    ')); //false
var_dump(has_alpha(' 123  ')); //false
var_dump(has_alpha(' !@#$%')); //false
```
'@