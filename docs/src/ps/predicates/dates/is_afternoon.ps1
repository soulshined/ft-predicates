Build-DocPredicate `
    -Name 'is_afternoon' `
    -Signature '(string | DateTimeInterface | null $value = null): bool' `
    -ReturnClause 'This predicate returns true if `$value` has a locale-aware period of ''afternoon''' `
    -Tags locale-aware `
    -Related is_am, is_pm, is_evening, is_midnight, is_morning, is_noon `
    `
    -Body @'
> **Warning** not all locales have an afternoon idiom
>
> For more info see https://unicode-org.github.io/cldr-staging/charts/38/supplemental/day_periods.html

> **Note** When `$value` is null, the current timestamp is used
'@ `
    -Examples @'
```
var_dump(is_afternoon());
var_dump(is_afternoon('T00:00 UTC')); //false
var_dump(is_afternoon('T03:00 UTC')); //false
var_dump(is_afternoon('T05:59 UTC')); //false
var_dump(is_afternoon('T06:00 UTC')); //false
var_dump(is_afternoon('T11:59 UTC')); //false
var_dump(is_afternoon('T12:00 UTC')); //true
var_dump(is_afternoon('T12:59 UTC')); //true
var_dump(is_afternoon('T13:00 UTC')); //true
var_dump(is_afternoon('T15:00 UTC')); //true
var_dump(is_afternoon('T17:59 UTC')); //true
var_dump(is_afternoon('T18:00 UTC')); //false
var_dump(is_afternoon('T20:59 UTC')); //false
var_dump(is_afternoon('T21:00 UTC')); //false
var_dump(is_afternoon('T23:59 UTC')); //false
var_dump(is_afternoon('T24:00 UTC')); //false
```
'@