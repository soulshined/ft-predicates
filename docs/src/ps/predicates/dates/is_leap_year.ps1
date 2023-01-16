Build-DocPredicate `
    -Name 'is_leap_year' `
    -Signature '(string | DateTimeInterface | null $value = null): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a leap year' `
    -Tags locale-aware `
    `
    -Body @'
> **Note** When `$value` is null, the current timestamp is used
'@ `
    -Examples @'
```
var_dump(is_leap_year());
var_dump(is_leap_year('2022-09-01')); //false
var_dump(is_leap_year('2020')); //true
var_dump(is_leap_year(2024)); //true
```
'@