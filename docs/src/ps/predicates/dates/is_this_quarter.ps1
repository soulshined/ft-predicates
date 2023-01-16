Build-DocPredicate `
    -Name 'is_this_quarter' `
    -Signature '(string | DateTimeInterface | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` falls within this quarter' `
    -Tags locale-aware `
    -Related is_last_quarter, is_next_quarter `
    `
    -Examples @'
.assuming the current date is January 01 2023
```
var_dump(is_this_quarter(1)); //true
var_dump(is_this_quarter('01')); //true
var_dump(is_this_quarter('1999-01-01')); //false
var_dump(is_this_quarter('2023-01-01')); //true
var_dump(is_this_quarter('2023-04-01')); //false
```
'@