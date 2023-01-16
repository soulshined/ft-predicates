Build-DocPredicate `
    -Name 'is_digit' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if all characters in `$value` are digits as defined by `IntlChar::isdigit()`' `
    -Related has_digit, has_text `
    `
    -Examples @'
```
var_dump(is_digit('')); //false
var_dump(is_digit('12345  ')); //false
var_dump(is_digit('12345')); //true
var_dump(is_digit(12345)); //true
```
'@