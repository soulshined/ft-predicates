Build-DocPredicate `
    -Name 'is_between' `
    -Signature '(string | int | float | null $value, string | int | float | null $a, string | int | float | null $b): bool' `
    -ReturnClause 'This predicate returns true if `$value` is between two numbers (exclusive)' `
    -Related is_in_range `
    `
    -Examples @'
```
var_dump(is_between(null, 0, 10)); //false
var_dump(is_between(0, 0, 10)); //false
var_dump(is_between(10, 0, 10)); //false
var_dump(is_between(5, 0, 10)); //true
var_dump(is_between(0.5, 0, 10)); //true
var_dump(is_between('5', 0, 10)); //true
var_dump(is_between('.5', 0, 10)); //true
```
'@