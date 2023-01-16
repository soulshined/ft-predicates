Build-DocPredicate `
    -Name 'is_actual_short' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns if `C_SHORT_MIN >= $value <= C_SHORT_MAX` and is not an e-notated number/numeric string and is not a float, including `.00` floats' `
    -Related is_actual_byte, is_actual_int, is_actual_float, is_actual_long `
    `
    -Examples @'
```
var_dump(is_actual_short(.5)); //false
var_dump(is_actual_short('abc')); //false
var_dump(is_actual_short('125.')); //false
var_dump(is_actual_short('-.5')); //false
var_dump(is_actual_short(125.)); //false
var_dump(is_actual_short(1e+10)); //false
var_dump(is_actual_short('1e+10')); //false
var_dump(is_actual_short(PHP_INT_MAX)); //false
var_dump(is_actual_short(PHP_INT_MAX + 1)); //false
var_dump(is_actual_short(2_147_483_647)); //false
var_dump(is_actual_short(-32768)); //true
var_dump(is_actual_short(32767)); //true
var_dump(is_actual_short(32768)); //false
```
'@