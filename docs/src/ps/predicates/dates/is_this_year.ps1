Build-DocPredicate `
    -Name 'is_this_year' `
    -Signature '(string | DateTimeInterface | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` falls within this year' `
    -Tags locale-aware `
    -Related is_last_year, is_next_year `
    `
    -Examples @'
.assuming the current date is January 01 2023
```
var_dump(is_this_year('2022-09-01')); //false
var_dump(is_this_year('2022')); //false
var_dump(is_this_year(2023)); //true
var_dump(is_this_year(new DateTime('first day of this year'))); //true
```
'@