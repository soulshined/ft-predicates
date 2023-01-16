Build-DocPredicate `
    -Name 'is_whitespace' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if all characters in `$value` are whitespace characters as defined by `IntlChar::isUWhitespace()`' `
    -Related has_whitespace `
    `
    -Examples @'
```
var_dump(is_whitespace('')); //false
var_dump(is_whitespace('   A')); //false
var_dump(is_whitespace(' ')); //true
var_dump(is_whitespace(mb_chr(013))); //true
```
'@