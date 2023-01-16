Build-DocPredicate `
    -Name 'is_negative' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a negative number' `
    -Related is_positive `
    `
    -Examples @'
```
var_dump(is_negative(-1)); //true
var_dump(is_negative('0')); //false
var_dump(is_negative(PHP_INT_MIN)); //true
var_dump(is_negative(-.5)); //true
var_dump(is_negative(PHP_INT_MAX)); //false
```
'@