Build-DocPredicate `
    -Name 'is_zero' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is 0' `
    -Related is_non_zero `
    `
    -Examples @'
```
var_dump(is_zero(-1)); //false
var_dump(is_zero('0')); //true
var_dump(is_zero(0)); //true
var_dump(is_zero("abc")); //false
var_dump(is_zero(1e+10)); //false
```
'@