Build-DocPredicate `
    -Name 'is_start_of_month' `
    -Signature '(string | DateTimeInterface | null $value = null): bool' `
    -ReturnClause 'This predicate returns true if `$value` is less than or equal to the first half of the `$value` month' `
    -Tags locale-aware `
    -Related is_end_of_month `
    `
    -Body @'
> **Note** When `$value` is null, the current timestamp is used

The start of month is calculated as such:

`$value <= floor(max_days_in_month / 2)`
'@ `
    -Examples @'
```
var_dump(is_start_of_month());
var_dump(is_start_of_month('2023-01-01')); //true
var_dump(is_start_of_month('2023-01-15')); //true
var_dump(is_start_of_month('2023-01-16')); //false
```
'@