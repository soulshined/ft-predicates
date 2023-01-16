Build-DocPredicate `
    -Name 'is_lower' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if all the alpha characters in a string are lowercase as, omitting whitespace and punctuation from validation as defined by `IntlChar::isULowercase()`' `
    -Related is_lower_strict, is_upper `
    `
    -Examples @'
```
var_dump(is_lower('aAeuhtns')); //false
var_dump(is_lower('')); //false
var_dump(is_lower('  aaeuhtns99')); //true
var_dump(is_lower('aaeuhtns99')); //true
```
'@