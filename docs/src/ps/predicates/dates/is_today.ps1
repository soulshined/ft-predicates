Build-DocPredicate `
    -Name 'is_today' `
    -Signature '(string | DateTimeInterface | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is today' `
    -Tags locale-aware `
    -Related is_yesterday, is_tomorrow `
    `
    -Examples @'
.assuming the current date is January 01 2023
```
var_dump(is_today('01')); //true
var_dump(is_today(1)); //true
var_dump(is_today('sun'))); //true
var_dump(is_today('sunday'))); //true
var_dump(is_today(new DateTime('2022-01-01'))); //false
var_dump(is_today(new DateTime('2023-01-01'))); //true
```
'@