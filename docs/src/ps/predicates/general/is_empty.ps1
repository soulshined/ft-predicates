Build-DocPredicate `
    -Name 'is_empty' `
    -ReturnClause 'This predicate returns true if `$value` is not empty' `
    -Body @'
The following conditions statisfy 'empty':
* `$value` is `null`
* `$value` is string and `strlen($value) == 0` (trim applied)
* `$value` is array and array is empty
* `$value` is object and `get_object_vars($value)` is empty
* `$value` is numeric and `$value == 0`
'@ `
    -Examples @'
```
var_dump(is_empty(null)); //true
var_dump(is_empty('')); //true
var_dump(is_empty('     ')); //true
var_dump(is_empty(Array())); //true
var_dump(is_empty(new stdClass)); //true
var_dump(is_empty(new class {})); //true
var_dump(is_empty('000')); //true
var_dump(is_empty(0)); //true
```
'@