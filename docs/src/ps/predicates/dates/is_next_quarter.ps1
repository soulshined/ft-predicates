Build-DocPredicate `
    -Name 'is_next_quarter' `
    -Signature '(string | DateTimeInterface | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` falls within the next quarter, cycling' `
    -Tags locale-aware `
    -Related is_this_quarter, is_last_quarter `
    `
    -Examples @'
.assuming the current date is January 01 2023
```
var_dump(is_next_quarter(1)); //false
var_dump(is_next_quarter(2)); //true
var_dump(is_next_quarter('02')); //true
var_dump(is_next_quarter('2023-03-01')); //false
var_dump(is_next_quarter('1999-04-01')); //false
var_dump(is_next_quarter('2023-04-01')); //true
```
'@