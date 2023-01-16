Build-DocPredicate `
    -Name 'is_e_notation' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is an e-notated number/numeric string' `
    -Tags locale-aware `
    `
    -Examples @'
```
var_dump(is_e_notation(1e0)); //false
var_dump(is_e_notation('1e10')); //true
var_dump(is_e_notation('1e+10')); //true
var_dump(is_e_notation('1e-10')); //true
var_dump(is_e_notation(PHP_INT_MAX + 1)); //true
```
'@