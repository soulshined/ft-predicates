Build-DocPredicate `
    -Name 'has_digit' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if any character in `$value` is a digit as defined by `IntlChar::isdigit()`' `
    -Related has_text, is_digit `
    `
    -Examples @'
```
var_dump(has_digit('   aoeuhtns12  3')); //true
var_dump(has_digit('a0eu.1')); //true
var_dump(has_digit('a!@#$eu   ')); //false
var_dump(has_digit('')); //false
var_dump(has_digit('    ')); //false
var_dump(has_digit(' 123  ')); //true
var_dump(has_digit(' !@#$%')); //false
```
'@