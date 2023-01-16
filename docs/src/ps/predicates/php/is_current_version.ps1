Build-DocPredicate `
    -Name 'is_current_version' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` falls between the beginning of the current minor version and the next minor version' `
    -Related is_future_version, is_past_version `
    `
    -Examples @'
.assuming the current php version is 8.1.0
```
var_dump(is_current_version("8.1.0")); //true
var_dump(is_current_version("8.1.99")); //true
var_dump(is_current_version("8.2.0")); //false
```
'@