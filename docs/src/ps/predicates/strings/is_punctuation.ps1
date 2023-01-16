Build-DocPredicate `
    -Name 'is_punctuation' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if all characters in `$value` are punctuation characters - any printable character that is not `IntlChar::isdigit` and not `IntlChar::isblank` and not `IntlChar::isUAlphabetic` which emulates `ctype_punct()`' `
    -Related has_text, has_punctuation `
    `
    -Examples @'
```
var_dump(is_punctuation('$1,000')); //false
var_dump(is_punctuation('!@#$%')); //true
var_dump(is_punctuation(' ... ')); //false
var_dump(is_punctuation('...')); //true
```
'@