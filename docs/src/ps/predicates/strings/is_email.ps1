Build-DocPredicate `
    -Name 'is_email' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a valid email as defined by `filter_var()`' `
    `
    -Examples @'
```
var_dump(is_email('example@example')); //false
var_dump(is_email('example@example.com')); //true
var_dump(is_email('Abc\@def@example.com')); //false
var_dump(is_email('Fred\ Bloggs@example.com')); //false
var_dump(is_email('$A12345@example.com')); //true
var_dump(is_email('customer/department=shipping@example.com')); //true
```
'@