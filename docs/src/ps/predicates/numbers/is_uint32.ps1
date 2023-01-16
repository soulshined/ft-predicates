Build-DocPredicate `
    -Name 'is_uint32' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `0 >= $value <= C_UINT_MAX` and is not an e-notated value' `
    -Related is_int32 `
    `
    -Examples @'
```
var_dump(is_uint32(-1)); //false
var_dump(is_uint32('0')); //true
var_dump(is_uint32(.5)); //false
var_dump(is_uint32(4_294_967_295)); //true
var_dump(is_uint32(4_294_967_296)); //false
```
'@