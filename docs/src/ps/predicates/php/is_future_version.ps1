Build-DocPredicate `
    -Name 'is_future_version' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is greater than the `PHP_VERSION` constant value' `
    -Related is_current_version, is_past_version `
    `
    -Examples @'
.assuming the current php version is 8.1.8
```
var_dump(is_future_version("8.1.0")); //false
var_dump(is_future_version("8.1.9")); //true
var_dump(is_future_version("9")); //true
var_dump(is_future_version("9.0")); //true
```
'@