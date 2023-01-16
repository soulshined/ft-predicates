Build-DocPredicate `
    -Name 'is_weekend_day' `
    -Signature '(string | DateTimeInterface | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a weekend day name or weekend day abbreviation or weekend day number' `
    -Tags locale-aware `
    -Related is_dayofweek, is_weekend_day `
    `
    -Examples @'
```
var_dump(is_weekend_day());
var_dump(is_weekend_day('sat')); //true
var_dump(is_weekend_day('saturday')); //true
var_dump(is_weekend_day('7')); //true
var_dump(is_weekend_day('mon')); //false
```

.emulating locale `he_IL` where the work week is Sunday - Thursday in Isreal; first day being Sunday `יום ראשון`
```
var_dump(is_weekday('יום שישי')); //friday false
var_dump(is_weekend_day('יום שישי')); //friday true
```
'@