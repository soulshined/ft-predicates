Build-DocPredicate `
    -Name 'is_false' `
    -ReturnClause 'This predicate returns true if `$value` is false literal' `
    -Related is_not_false, is_falsy, is_not, is_true, is_truthy `
    `
    -Examples @'
```
var_dump(is_false('0')); //false
var_dump(is_false(false)); //true
```
'@