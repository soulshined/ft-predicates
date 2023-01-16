Build-DocPredicate `
    -Name 'is_not_true' `
    -ReturnClause 'This predicate returns true if `$value` is not true literal' `
    -Related is_false, is_not_false, is_falsy, is_true, is_truthy `
    `
    -Examples @'
```
var_dump(is_not_true(false)); //true
var_dump(is_not_true(true)); //false
var_dump(is_not_true(12350987)); //true
var_dump(is_not_true(new stdClass)); //true
var_dump(is_not_true("Hello World")); //true
```
'@