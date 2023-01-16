Build-DocPredicate `
    -Name 'is_ubyte' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `0 >= $value <= C_UBYTE_MAX` and is not an e-notated value' `
    -Related is_byte `
    `
    -Examples @'
```
var_dump(is_ubyte(-1)); //false
var_dump(is_ubyte('0')); //true
var_dump(is_ubyte(.5)); //false
var_dump(is_ubyte(255)); //true
var_dump(is_ubyte(256)); //false
```
'@