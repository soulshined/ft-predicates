Build-DocPredicate `
    -Name 'is_pm' `
    -Signature '(string | DateTimeInterface | null $value = null): bool' `
    -ReturnClause 'This predicate returns true if `$value` has a meridiem value of ''pm''' `
    -Tags locale-aware `
    -Related is_am, is_evening, is_midnight, is_afternoon, is_morning, is_pm `
    `
    -Body @'
> **Note** When `$value` is null, the current timestamp is used
'@ `
    -Examples @'
```
var_dump(is_pm());
var_dump(is_pm('T00:00 UTC')); //false
var_dump(is_pm('T03:00 UTC')); //false
var_dump(is_pm('T05:59 UTC')); //false
var_dump(is_pm('T06:00 UTC')); //false
var_dump(is_pm('T11:59 UTC')); //false
var_dump(is_pm('T12:00 UTC')); //true
var_dump(is_pm('T12:59 UTC')); //true
var_dump(is_pm('T13:00 UTC')); //true
var_dump(is_pm('T15:00 UTC')); //true
var_dump(is_pm('T17:59 UTC')); //true
var_dump(is_pm('T18:00 UTC')); //true
var_dump(is_pm('T20:59 UTC')); //true
var_dump(is_pm('T21:00 UTC')); //true
var_dump(is_pm('T23:59 UTC')); //true
var_dump(is_pm('T24:00 UTC')); //false
```
'@