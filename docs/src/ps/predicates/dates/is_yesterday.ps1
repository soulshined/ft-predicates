Build-DocPredicate `
    -Name 'is_yesterday' `
    -Signature '(string | DateTimeInterface | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is yesterday' `
    -Tags locale-aware `
    -Related is_today, is_tomorrow `
    `
    -Examples @'
.assuming the current date is January 01 2023
```
var_dump(is_yesterday('31')); //true
var_dump(is_yesterday(31)); //true
var_dump(is_yesterday('saturday')); //true
var_dump(is_yesterday('sat')); //true
var_dump(is_yesterday(new DateTime('2022-12-31T13:00'))); //true
```
'@