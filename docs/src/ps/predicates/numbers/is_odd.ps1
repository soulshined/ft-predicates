Build-DocPredicate `
    -Name 'is_odd' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is an odd number' `
    -Related is_even `
    `
    -Examples @'
```
var_dump(is_odd(0)); //false
var_dump(is_odd('1')); //true
var_dump(is_odd(-101)); //true
var_dump(is_odd(3)); //true
var_dump(is_odd(3.00)); //true
```
'@