Build-DocPredicate `
    -Name 'is_positive' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a positive number' `
    -Related is_negative `
    `
    -Examples @'
```
var_dump(is_positive(-1)); //false
var_dump(is_positive('0')); //false
var_dump(is_positive(PHP_INT_MIN)); //false
var_dump(is_positive(.5)); //true
var_dump(is_positive(PHP_INT_MAX)); //true
var_dump(is_positive(1e+10)); //true
```
'@