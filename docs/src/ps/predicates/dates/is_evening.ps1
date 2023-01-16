Build-DocPredicate `
    -Name 'is_evening' `
    -Signature '(string | DateTimeInterface | null $value = null): bool' `
    -ReturnClause 'This predicate returns true if `$value` has a locale-aware period of ''evening''' `
    -Tags locale-aware `
    -Related is_evening, is_pm, is_afternoon, is_midnight, is_morning, is_noon `
    `
    -Body @'
> **Warning** not all locales have an evening idiom
>
> For more info see https://unicode-org.github.io/cldr-staging/charts/38/supplemental/day_periods.html

> **Note** When `$value` is null, the current timestamp is used
'@ `
    -Examples @'
```
var_dump(is_evening());
var_dump(is_evening('T00:00 UTC')); //false
var_dump(is_evening('T03:00 UTC')); //false
var_dump(is_evening('T05:59 UTC')); //false
var_dump(is_evening('T06:00 UTC')); //false
var_dump(is_evening('T11:59 UTC')); //false
var_dump(is_evening('T12:00 UTC')); //false
var_dump(is_evening('T12:59 UTC')); //false
var_dump(is_evening('T13:00 UTC')); //false
var_dump(is_evening('T15:00 UTC')); //false
var_dump(is_evening('T17:59 UTC')); //false
var_dump(is_evening('T18:00 UTC')); //true
var_dump(is_evening('T20:59 UTC')); //true
var_dump(is_evening('T21:00 UTC')); //false
var_dump(is_evening('T23:59 UTC')); //false
var_dump(is_evening('T24:00 UTC')); //false
```
'@