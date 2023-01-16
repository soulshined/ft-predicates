Build-DocPredicate `
    -Name 'is_future' `
    -Signature '(string | DateTimeInterface | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is in the future' `
    -Tags locale-aware `
    -Related is_past, is_within_date_range `
    `
    -Examples @'
```
var_dump(is_future('2999-12-31T00:00 UTC')); //true
var_dump(is_future('1999-12-31T00:00 UTC')); //false
var_dump(is_future('+1 day')); //true
var_dump(is_future('-1 day')); //false
'@