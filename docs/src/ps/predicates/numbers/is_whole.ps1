Build-DocPredicate `
    -Name 'is_whole' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a natural number, including zero' `
    -Related is_natural `
    `
    -Examples @'
```
var_dump(is_whole(-1)); //false
var_dump(is_whole('0')); //true
var_dump(is_whole(1e+10)); //false
var_dump(is_whole('1e+10')); //false
var_dump(is_whole(1.5)); //false
var_dump(is_whole(PHP_INT_MAX)); //true
var_dump(is_whole(100)); //true
var_dump(is_whole(PHP_INT_MIN)); //false
var_dump(is_whole(PHP_INT_MAX + 1)); //true
```
'@