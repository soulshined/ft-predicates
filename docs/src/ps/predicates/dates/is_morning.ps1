Build-DocPredicate `
    -Name 'is_morning' `
    -Signature '(string | DateTimeInterface | null $value = null): bool' `
    -ReturnClause 'This predicate returns true if `$value` has a locale-aware period of ''morning''' `
    -Tags locale-aware `
    -Related is_morning, is_pm, is_evening, is_midnight, is_afternoon, is_noon `
    `
    -Body @'
> **Warning** not all locales have a morning idiom
>
> For more info see https://unicode-org.github.io/cldr-staging/charts/38/supplemental/day_periods.html

> **Note** When `$value` is null, the current timestamp is used
'@ `
    -Examples @'
```
var_dump(is_morning());
var_dump(is_morning('T00:00 UTC')); //false
var_dump(is_morning('T03:00 UTC')); //false
var_dump(is_morning('T05:59 UTC')); //false
var_dump(is_morning('T06:00 UTC')); //true
var_dump(is_morning('T11:59 UTC')); //true
var_dump(is_morning('T12:00 UTC')); //false
var_dump(is_morning('T12:59 UTC')); //false
var_dump(is_morning('T13:00 UTC')); //false
var_dump(is_morning('T15:00 UTC')); //false
var_dump(is_morning('T17:59 UTC')); //false
var_dump(is_morning('T18:00 UTC')); //false
var_dump(is_morning('T20:59 UTC')); //false
var_dump(is_morning('T21:00 UTC')); //false
var_dump(is_morning('T23:59 UTC')); //false
var_dump(is_morning('T24:00 UTC')); //false
```
'@