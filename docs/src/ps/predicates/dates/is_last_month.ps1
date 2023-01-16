Build-DocPredicate `
    -Name 'is_last_month' `
    -Signature '(string | DateTimeInterface | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` falls within last month' `
    -Tags locale-aware `
    -Related is_this_month, is_next_month `
    `
    -Examples @'
.assuming the current date is January 01 2023
```
var_dump(is_last_month('december')); //true
var_dump(is_last_month('dec')); //true
var_dump(is_last_month('12')); //true
var_dump(is_last_month(12)); //true
var_dump(is_last_month('-1 month')); //true
var_dump(is_last_month(new DateTime('1999-12-31'))); //false
```

.emulating locale `kr_KR`
```
var_dump(is_last_month('december')); //true
var_dump(is_last_month('십이월')); //true
```
'@