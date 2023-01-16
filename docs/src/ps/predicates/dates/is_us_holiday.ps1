Build-DocPredicate `
    -Name 'is_us_holiday' `
    -Signature '(string | DateTimeInterface | null $value = null): bool' `
    -ReturnClause 'This predicate returns true if `$value` lands on a fixed or observed us federal holiday for `$value` year' `
    -Tags locale-aware `
    `
    -Body @'
> **Note** When `$value` is null, the current timestamp is used

> **Tip** This method accounts for when the holiday was established. For example, if the date is `Jan 1st 1869`, it will not be New Years since the holiday was established in 1870
'@ `
    -Examples @'
```
var_dump(is_us_holiday());
var_dump(is_us_holiday('2023-01-01')); //true
var_dump(is_us_holiday('fourth thursday of November this year')); //true
var_dump(is_us_holiday('fourth thursday of November 2024')); //true
var_dump(is_us_holiday('2023-12-25')); //true
```
'@