Build-DocPredicate `
    -Name 'is_past_version' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns if `$value` is less than the `PHP_VERSION` constant value' `
    -Related is_current_version, is_future_version `
    `
    -Examples @'
.assuming the current php version is 8.1.8
```
var_dump(is_past_version("8.1.0")); //true
var_dump(is_past_version("8.1.8")); //false
var_dump(is_past_version("8.1.7")); //true
var_dump(is_past_version("8")); //true
```
'@