Build-DocPredicate `
    -Name 'is_even' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is an even number' `
    -Related is_odd `
    `
    -Examples @'
```
var_dump(is_even(0)); //true
var_dump(is_even('1')); //false
var_dump(is_even(-100)); //true
var_dump(is_even(4)); //true
var_dump(is_even(4.00)); //true
```
'@