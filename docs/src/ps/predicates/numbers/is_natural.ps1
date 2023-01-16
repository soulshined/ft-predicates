Build-DocPredicate `
    -Name 'is_natural' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is within all whole numbers - positive integers excluding zero. Returns false if `$value` is an e-notated value' `
    -Related is_positive `
    `
    -Body @'
> **Note** When a number exceeds `C_LONG_MAX` a 'natural number' is then considered as any float value with a `.00` scale
'@ `
    -Examples @'
```
var_dump(is_natural(-1)); //false
var_dump(is_natural('0')); //false
var_dump(is_natural(1e+10)); //false
var_dump(is_natural('1e+10')); //false
var_dump(is_natural(1.5)); //false
var_dump(is_natural(PHP_INT_MAX)); //true
var_dump(is_natural(100)); //true
var_dump(is_natural(PHP_INT_MIN)); //false
var_dump(is_natural(PHP_INT_MAX + 1)); //true
```
'@