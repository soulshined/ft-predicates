Build-DocPredicate `
    -Name 'is_end_of_month' `
    -Signature '(string | DateTimeInterface | null $value = null): bool' `
    -ReturnClause 'This predicate returns true if `$value` is greater than or equal to the last half of the `$value` month' `
    -Tags locale-aware `
    -Related is_start_of_month `
    `
    -Body @'
> **Note** When `$value` is null, the current timestamp is used

The end of month is calculated as such:

`$value >= floor(max_days_in_month / 2)`
'@ `
    -Examples @'
```
var_dump(is_end_of_month());
var_dump(is_end_of_month('2023-01-01')); //false
var_dump(is_end_of_month('2023-01-14')); //false
var_dump(is_end_of_month('2023-01-15')); //true
```
'@