Build-DocPredicate `
    -Name 'is_last_quarter' `
    -Signature '(string | DateTimeInterface | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` falls within the last quarter, cycling' `
    -Tags locale-aware `
    -Related is_this_quarter, is_next_quarter `
    `
    -Examples @'
.assuming the current date is January 01 2023
```
var_dump(is_last_quarter(1)); //false
var_dump(is_last_quarter(4)); //true
var_dump(is_last_quarter('04')); //true
var_dump(is_last_quarter('2022-09-01')); //false
var_dump(is_last_quarter('1999-10-01')); //false
var_dump(is_last_quarter('2022-10-01')); //true
```
'@