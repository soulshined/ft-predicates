Build-DocPredicate `
    -Name 'is_truthy' `
    -ReturnClause 'This predicate returns true if `$value` is ''truthy'', or true-like' `
    -Related is_false, is_not_false, is_falsy, is_not, is_true `
    `
    -Examples @'
```
var_dump(is_truthy('0')); //false
var_dump(is_truthy('1')); //true
var_dump(is_truthy(true)); //true
var_dump(is_truthy('TRUE')); //true
var_dump(is_truthy('t')); //true
var_dump(is_truthy('y')); //true
var_dump(is_truthy('yes')); //true
var_dump(is_truthy('on')); //true
var_dump(is_truthy('      true')); //true
```
'@