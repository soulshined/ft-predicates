Build-DocPredicate `
    -Name 'is_noon' `
    -Signature '(string | DateTimeInterface | null $value = null): bool' `
    -ReturnClause 'This predicate returns true if `$value` has a meridiem value of ''noon''' `
    -Tags locale-aware `
    -Related is_noon, is_pm, is_evening, is_midnight, is_morning, is_afternoon `
    `
    -Body @'
> **Warning** not all locales have a noon idiom
>
> For more info see https://www.unicode.org/reports/tr35/tr35-dates.html#Day_Period_Rules

> **Note** When `$value` is null, the current timestamp is used
'@ `
    -Examples @'
```
var_dump(is_noon());
var_dump(is_noon('T00:00 UTC')); //false
var_dump(is_noon('T03:00 UTC')); //false
var_dump(is_noon('T05:59 UTC')); //false
var_dump(is_noon('T06:00 UTC')); //false
var_dump(is_noon('T11:59 UTC')); //false
var_dump(is_noon('T12:00 UTC')); //true
var_dump(is_noon('T12:59 UTC')); //true
var_dump(is_noon('T13:00 UTC')); //false
var_dump(is_noon('T15:00 UTC')); //false
var_dump(is_noon('T17:59 UTC')); //false
var_dump(is_noon('T18:00 UTC')); //false
var_dump(is_noon('T20:59 UTC')); //false
var_dump(is_noon('T21:00 UTC')); //false
var_dump(is_noon('T23:59 UTC')); //false
var_dump(is_noon('T24:00 UTC')); //false
```
'@