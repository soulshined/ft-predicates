Build-DocPredicate `
    -Name 'is_actual_long' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `C_LONG_MIN >= $value <= C_LONG_MAX` and is not an e-notated number/numeric string and is not a float' `
    -Related is_actual_byte, is_actual_int, is_actual_float, is_actual_short `
    `
    -Examples @'
```
var_dump(is_actual_long(.5)); //false
var_dump(is_actual_long('abc')); //false
var_dump(is_actual_long('125.')); //false
var_dump(is_actual_long('-.5')); //false
var_dump(is_actual_long(125.)); //false
var_dump(is_actual_long(1e+10)); //false
var_dump(is_actual_long('1e+10')); //false
var_dump(is_actual_long(PHP_INT_MAX)); //true
var_dump(is_actual_long(PHP_INT_MAX + 1)); //false
var_dump(is_actual_long(2_147_483_647)); //true
```
'@