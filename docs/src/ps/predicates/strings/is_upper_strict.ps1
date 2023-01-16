Build-DocPredicate `
    -Name 'is_upper_strict' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if all of the characters in the string are uppercase as defined by `IntlChar::isUUppercase()`' `
    -Related is_upper, is_lower `
    `
    -Examples @'
```
var_dump(is_upper_strict('aAeuhtns')); //false
var_dump(is_upper_strict('')); //false
var_dump(is_upper_strict('     AAEUHTNS')); //false
var_dump(is_upper_strict('AAEUHTNS99')); //false
var_dump(is_upper_strict('AAEUHTNS')); //true
```
'@