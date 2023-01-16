Build-DocPredicate `
    -Name 'is_am' `
    -Signature '(string | DateTimeInterface | null $value = null): bool' `
    -ReturnClause 'This predicate returns true if `$value` has a meridiem value of ''am''' `
    -Tags locale-aware `
    -Related is_pm, is_evening, is_midnight, is_afternoon, is_morning, is_noon `
    `
    -Body @'
> **Note** When `$value` is null, the current timestamp is used
'@ `
    -Examples @'
```
var_dump(is_am());
var_dump(is_am('T00:00 UTC')); //true
var_dump(is_am('T03:00 UTC')); //true
var_dump(is_am('T05:59 UTC')); //true
var_dump(is_am('T06:00 UTC')); //true
var_dump(is_am('T11:59 UTC')); //true
var_dump(is_am('T12:00 UTC')); //false
var_dump(is_am('T12:59 UTC')); //false
var_dump(is_am('T13:00 UTC')); //false
var_dump(is_am('T15:00 UTC')); //false
var_dump(is_am('T17:59 UTC')); //false
var_dump(is_am('T18:00 UTC')); //false
var_dump(is_am('T20:59 UTC')); //false
var_dump(is_am('T21:00 UTC')); //false
var_dump(is_am('T23:59 UTC')); //false
var_dump(is_am('T24:00 UTC')); //false
```
'@