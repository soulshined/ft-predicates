Build-DocPredicate `
    -Name 'is_actual_byte' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `C_BYTE_MIN >= $value <= C_BYTE_MAX` and is not an e-notated number/numeric string and is not a float, including `.00` floats' `
    -Related is_actual_int, is_actual_long, is_actual_float, is_actual_short `
    `
    -Examples @'
```
var_dump(is_actual_byte(.5)); //false
var_dump(is_actual_byte('abc')); //false
var_dump(is_actual_byte('125')); //true
var_dump(is_actual_byte(1e+10)); //false
var_dump(is_actual_byte('1e+10')); //false
var_dump(is_actual_byte(127)); //true
var_dump(is_actual_byte(128)); //false
var_dump(is_actual_byte(-128)); //true
```
'@