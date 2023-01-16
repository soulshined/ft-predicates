Build-DocPredicate `
    -Name 'is_this_month' `
    -Signature '(string | DateTimeInterface | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` falls within this month' `
    -Tags locale-aware `
    -Related is_last_month, is_next_month `
    `
    -Examples @'
.assuming the current date is January 01 2023
```
var_dump(is_this_month('january')); //true
var_dump(is_this_month('jan')); //true
var_dump(is_this_month('01')); //true
var_dump(is_this_month(1)); //true
var_dump(is_this_month('3000-01-15')); //false
var_dump(is_this_month('2023-01-15')); //true
```
'@