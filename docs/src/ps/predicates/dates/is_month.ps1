Build-DocPredicate `
    -Name 'is_month' `
    -Signature '(string | int | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a month name or month abbreviation or month number (0?1-12)' `
    -Tags locale-aware `
    -Related is_month_abbr, is_month_name `
    `
    -Body @'
> **Note** Use's english fallbacks in addition to any translated or supported locale specific values
'@ `
    -Examples @'
```
var_dump(is_month(0)); //false
var_dump(is_month(1)); //true
var_dump(is_month('1')); //true
var_dump(is_month('04')); //true
var_dump(is_month('jan')); //true
var_dump(is_month('DECEMBER')); //true
```

.emulating locale `kr_KR`
```
var_dump(is_month('DECEMBER')); //true
var_dump(is_month('십이월')); //true
```
'@