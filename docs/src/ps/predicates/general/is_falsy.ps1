Build-DocPredicate `
    -Name 'is_falsy' `
    -ReturnClause 'This predicate returns true if `$value` is ''falsy'', or false-like' `
    -Related is_false, is_not_false, is_not, is_true, is_truthy `
    `
    -Examples @'
```
var_dump(is_falsy('0')); //true
var_dump(is_falsy('1')); //false
var_dump(is_falsy(false)); //true
var_dump(is_falsy('FALSE')); //true
var_dump(is_falsy('f')); //true
var_dump(is_falsy('n')); //true
var_dump(is_falsy('no')); //true
var_dump(is_falsy('off')); //true
var_dump(is_falsy('      false')); //true
```
'@