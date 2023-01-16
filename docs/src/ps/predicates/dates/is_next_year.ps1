Build-DocPredicate `
    -Name 'is_next_year' `
    -Signature '(string | DateTimeInterface | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` falls within next year' `
    -Tags locale-aware `
    -Related is_this_year, is_last_year `
    `
    -Examples @'
.assuming the current date is January 01 2023
```
var_dump(is_next_year('2024-09-01')); //true
var_dump(is_next_year('1999-10-01')); //false
var_dump(is_next_year('2024')); //true
var_dump(is_next_year(2024)); //true
```
'@