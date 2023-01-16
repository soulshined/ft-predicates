Build-DocPredicate `
    -Name 'is_upper' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if all the alpha characters in a string are uppercase, omitting whitespace and punctuation from validation as defined by `IntlChar::isUUppercase()`' `
    -Related is_upper_strict, is_lower `
    `
    -Examples @'
```
var_dump(is_upper('aAeuhtns')); //false
var_dump(is_upper('')); //false
var_dump(is_upper('     AAEUHTNS')); //true
var_dump(is_upper('AAEUHTNS99')); //true
```
'@