Build-DocPredicate `
    -Name 'is_ushort' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `0 >= $value <= C_USHORT_MAX` and is not an e-notated number/numeric string' `
    -Related is_short `
    `
    -Examples @'
```
var_dump(is_ushort(-1)); //false
var_dump(is_ushort('0')); //true
var_dump(is_ushort(.5)); //false
var_dump(is_ushort(65535)); //true
var_dump(is_ushort(C_USHORT_MAX + 1)); //false
```
'@