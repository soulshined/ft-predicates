Build-DocPredicate `
    -Name 'is_php8' `
    -Signature '(?string $value = null): bool' `
    -ReturnClause 'This predicate returns true if `$value` is greater than or equal to 8 and less than 9' `
    -Related is_php6, is_php7 `
    `
    -Body @'
> **Note** If `$value` is null `PHP_MAJOR_VERSION` will be used implicitly
'@ `
    -Examples @'
.assuming the current php version is 8.1.8
```
var_dump(is_php8("8")); //true
var_dump(is_php8("8.9.9")); //true
var_dump(is_php8("8")); //true
var_dump(is_php8()); //true
```
'@