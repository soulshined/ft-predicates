Build-DocPredicate `
    -Name 'is_non_zero' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is any number other than 0' `
    -Related is_zero, is_positive, is_negative `
    `
    -Examples @'
```
var_dump(is_non_zero(-1)); //true
var_dump(is_non_zero('0')); //false
var_dump(is_non_zero(0)); //false
var_dump(is_non_zero("abc")); //false
var_dump(is_non_zero(1e+10)); //true
```
'@