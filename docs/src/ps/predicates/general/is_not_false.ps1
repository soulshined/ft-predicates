Build-DocPredicate `
    -Name 'is_not_false' `
    -ReturnClause 'This predicate returns true if `$value` is not false literal' `
    -Related is_false, is_falsy, is_true, is_not_true, is_truthy `
    `
    -Examples @'
```
var_dump(is_not_false(false)); //false
var_dump(is_not_false(true)); //true
var_dump(is_not_false(12350987)); //true
var_dump(is_not_false(new stdClass)); //true
var_dump(is_not_false("Hello World")); //true
```
'@