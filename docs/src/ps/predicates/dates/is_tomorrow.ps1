Build-DocPredicate `
    -Name 'is_tomorrow' `
    -Signature '(string | DateTimeInterface | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is tomorrow' `
    -Tags locale-aware `
    -Related is_yesterday, is_today `
    `
    -Examples @'
.assuming the current date is January 01 2023
```
var_dump(is_tomorrow('02')); //true
var_dump(is_tomorrow(2)); //true
var_dump(is_today('mon'))); //true
var_dump(is_today('monday'))); //true
var_dump(is_tomorrow(new DateTime('2022-01-02'))); //false
var_dump(is_tomorrow(new DateTime('+1 day'))); //true
```
'@