Build-DocPredicate `
    -Name 'is_uint64' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `0 >= $value <= C_ULONG_MAX` and `$value` is a string and only a string value compared by `bccomp` and is not an e-notated number/numeric string' `
    -Related is_int32 `
    -Tags extn:bcmath `
    `
    -Examples @'
```
var_dump(is_uint64(-1)); //false
var_dump(is_uint64('0')); //true
var_dump(is_uint64(.5)); //false
var_dump(is_uint64(C_UINT_MAX + 1)); //true
var_dump(is_uint64('9223372036854775808')); //true
var_dump(is_uint64('18446744073709551615')); //true
var_dump(is_uint64('18446744073709551616')); //false
```

.demonstrating that php type juggles to a float
```
var_dump(is_uint64(PHP_INT_MAX + 1)); //false
```
'@