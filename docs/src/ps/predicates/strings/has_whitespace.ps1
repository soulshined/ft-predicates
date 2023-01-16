Build-DocPredicate `
    -Name 'has_whitespace' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if any of the characters in `$value` is a whitespace character as defined by `IntlChar::isUWhitespace()`' `
    -Related is_whitespace, has_text `
    `
    -Examples @'
```
var_dump(has_whitespace('a0eu.1')); //false
var_dump(has_whitespace('')); //false
var_dump(has_whitespace('    ')); //true
var_dump(has_whitespace(' 123  ')); //true

//vertical tab
var_dump(has_whitespace(mb_chr(013))); //true
```
'@