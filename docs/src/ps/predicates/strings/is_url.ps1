Build-DocPredicate `
    -Name 'is_url' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a valid url as defined by `filter_var()`' `
    `
    -Examples @'
```
var_dump(is_url('http://')); //false
var_dump(is_url('http://localhost')); //true
var_dump(is_url('http://localhost:8080')); //true
var_dump(is_url('http://user:password@example.com')); //true
```
'@