Build-DocPredicate `
    -Name 'is_last_year' `
    -Signature '(string | DateTimeInterface | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` falls within last year' `
    -Tags locale-aware `
    -Related is_this_year, is_next_year `
    `
    -Body @'

'@ `
    -Examples @'
.assuming the current date is January 01 2023
```
var_dump(is_last_year('2022-09-01')); //true
var_dump(is_last_year('1999-10-01')); //false
var_dump(is_last_year('2022')); //true
var_dump(is_last_year(2022)); //true
```
'@