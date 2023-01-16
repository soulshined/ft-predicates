Build-DocPredicate `
    -Name 'is_weekday' `
    -Signature '(string | DateTimeInterface | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a week day name or weekday abbreviation or a weekday number' `
    -Tags locale-aware `
    -Related is_dayofweek, is_weekend_day `
    `
    -Examples @'
```
var_dump(is_weekday());
var_dump(is_weekday('sat')); //false
var_dump(is_weekday('saturday')); //false
var_dump(is_weekday('7')); //false
var_dump(is_weekday('mon')); //true
```

.emulating locale `he_IL` where the work week is Sunday - Thursday in Isreal; first day being Sunday `יום ראשון`
```
var_dump(is_weekday('יום שישי')); //friday false
var_dump(is_weekend_day('יום שישי')); //friday true
```
'@