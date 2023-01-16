Build-DocPredicate `
    -Name 'is_non_null' `
    -ReturnClause 'This predicate returns true if `$value` is not null' `
    -Related is_nn_and, is_empty `
    `
    -Examples @'
```
var_dump(is_non_null(null)); //false
var_dump(is_non_null(new stdClass)); //true
var_dump(is_non_null(0)); //true
var_dump(is_non_null(false)); //true
```
'@