Build-DocPredicate `
    -Name 'is_true' `
    -ReturnClause 'This predicate returns true if `$value` is true literal' `
    -Related is_not_false, is_falsy, is_not, is_false, is_truthy `
    `
    -Examples @'
```
var_dump(is_true(1)); //false
var_dump(is_true(false)); //false
var_dump(is_true(true)); //false
```
'@