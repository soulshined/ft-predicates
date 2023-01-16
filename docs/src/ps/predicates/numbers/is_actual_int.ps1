Build-DocPredicate `
    -Name 'is_actual_int' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `C_INT_MIN >= $value <= C_INT_MAX` and is not an e-notated number/numeric string and is not a float, including `.00` floats' `
    -Related is_actual_byte, is_actual_long, is_actual_float, is_actual_short `
    `
    -Examples @'
```
var_dump(is_actual_int(.5)); //false
var_dump(is_actual_int('abc')); //false
var_dump(is_actual_int('125.')); //false
var_dump(is_actual_int('-.5')); //false
var_dump(is_actual_int(125.)); //false
var_dump(is_actual_int(1e+10)); //false
var_dump(is_actual_int('1e+10')); //false
var_dump(is_actual_int(PHP_INT_MAX)); //false
var_dump(is_actual_int(2_147_483_647)); //true
```
'@