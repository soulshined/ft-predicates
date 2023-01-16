Build-DocPredicate `
    -Name 'is_next_month' `
    -Signature '(string | DateTimeInterface | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` falls within next month' `
    -Tags locale-aware `
    -Related is_this_month, is_last_month `
    `
    -Examples @'
.assuming the current date is January 01 2023
```
var_dump(is_next_month('feb')); //true
var_dump(is_next_month('02')); //true
var_dump(is_next_month(2)); //true
var_dump(is_next_month(new DateTime('1999-02-01'))); //false
```

.emulating locale `kr_KR`
```
var_dump(is_next_month('february')); //true
var_dump(is_next_month('이월')); //true
```
'@