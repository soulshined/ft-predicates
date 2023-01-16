Build-DocPredicate `
    -Name 'is_past' `
    -Signature '(string | DateTimeInterface | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is in the past' `
    -Tags locale-aware `
    -Related is_future, is_within_date_range `
    `
    -Examples @'
```
var_dump(is_past('2999-12-31T00:00 UTC')); //false
var_dump(is_past('1999-12-31T00:00 UTC')); //true
var_dump(is_past('+1 day')); //false
var_dump(is_past('-1 day')); //true
```
'@