Build-DocPredicate `
    -Name 'is_php6' `
    -Signature '(?string $value = null): bool' `
    -ReturnClause 'This predicate returns true if `$value` is greater than or equal to 6 and less than 7' `
    -Related is_php7, is_php8 `
    `
    -Body @'
> **Note** If `$value` is null `PHP_MAJOR_VERSION` will be used implicitly
'@ `
    -Examples @'
.assuming the current php version is 8.1.8
```
var_dump(is_php6("6")); //true
var_dump(is_php6("6.9.9")); //true
var_dump(is_php6("7")); //false
var_dump(is_php6()); //false
```
'@