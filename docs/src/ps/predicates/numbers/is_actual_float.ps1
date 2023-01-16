Build-DocPredicate `
    -Name 'is_actual_float' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` has decimals and is not an e-notated numeric string' `
    -Related is_actual_byte, is_actual_int, is_actual_long, is_actual_short `
    -Tags locale-aware `
    `
    -Examples @'
```
var_dump(is_actual_float(.5)); //true
var_dump(is_actual_float('-.5')); //true
var_dump(is_actual_float('abc')); //false
var_dump(is_actual_float('125.')); //true
var_dump(is_actual_float(125.)); //true
var_dump(is_actual_float(1e+10)); //true
var_dump(is_actual_float('1e+10')); //false
var_dump(is_actual_float(PHP_INT_MAX)); //false
var_dump(is_actual_float(PHP_INT_MAX + 1)); //true
```
'@