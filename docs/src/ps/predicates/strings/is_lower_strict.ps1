Build-DocPredicate `
    -Name 'is_lower_strict' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if all of the characters in the string are lowercase as defined by `IntlChar::isULowercase()`' `
    -Related is_lower, is_upper `
    `
    -Examples @'
```
var_dump(is_lower_strict('aAeuhtns')); //false
var_dump(is_lower_strict('')); //false
var_dump(is_lower_strict('  aaeuhtns')); //false
var_dump(is_lower_strict('aaeuhtns')); //true
```
'@