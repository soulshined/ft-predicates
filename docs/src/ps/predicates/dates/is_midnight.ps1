Build-DocPredicate `
    -Name 'is_midnight' `
    -Signature '(string | DateTimeInterface | null $value = null): bool' `
    -ReturnClause 'This predicate returns true if `$value` is midnight (either 24:00 or 00:00)' `
    -Tags locale-aware `
    -Related is_midnight, is_pm, is_evening, is_midnight, is_morning, is_noon `
    `
    -Body @'
> **Note** When `$value` is null, the current timestamp is used
'@ `
    -Examples @'
```
var_dump(is_midnight());
var_dump(is_midnight('T00:00 UTC')); //true
var_dump(is_midnight('T03:00 UTC')); //false
var_dump(is_midnight('T05:59 UTC')); //false
var_dump(is_midnight('T06:00 UTC')); //false
var_dump(is_midnight('T11:59 UTC')); //false
var_dump(is_midnight('T12:00 UTC')); //false
var_dump(is_midnight('T12:59 UTC')); //false
var_dump(is_midnight('T13:00 UTC')); //false
var_dump(is_midnight('T15:00 UTC')); //false
var_dump(is_midnight('T17:59 UTC')); //false
var_dump(is_midnight('T18:00 UTC')); //false
var_dump(is_midnight('T20:59 UTC')); //false
var_dump(is_midnight('T21:00 UTC')); //false
var_dump(is_midnight('T23:59 UTC')); //false
var_dump(is_midnight('T24:00 UTC')); //true
```
'@