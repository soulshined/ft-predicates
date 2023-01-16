Build-DocPredicate `
    -Name 'has_punctuation' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if any character in `$value` is punctuation - any printable character that is not `IntlChar::isdigit` and not `IntlChar::isblank` and not `IntlChar::isUAlphabetic` which emulates `ctype_punct()`' `
    -Related is_punctuation, has_text `
    `
    -Examples @'
```
var_dump(has_punctuation('   aoeuhtns12  3')); //false
var_dump(has_punctuation('a0eu.1')); //true
var_dump(has_punctuation('a!@#$eu   ')); //true
var_dump(has_punctuation('')); //false
var_dump(has_punctuation('    ')); //false
var_dump(has_punctuation(' 123  ')); //false
```
'@