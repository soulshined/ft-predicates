Build-DocPredicate `
    -Name 'is_in_range' `
    -Signature '(string | int | float | null $value, string | int | float | null $a, string | int | float | null $b): bool' `
    -ReturnClause 'This predicate returns true if `$value` is between two numbers (inclusive)' `
    -Related is_between `
    `
    -Examples @'
```
var_dump(is_in_range(null, 0, 10)); //false
var_dump(is_in_range(0, 0, 10)); //true
var_dump(is_in_range(10, 0, 10)); //true
var_dump(is_in_range(5, 0, 10)); //true
var_dump(is_in_range(0.5, 0, 10)); //true
var_dump(is_in_range('5', 0, 10)); //true
var_dump(is_in_range('.5', 0, 10)); //true
```
'@