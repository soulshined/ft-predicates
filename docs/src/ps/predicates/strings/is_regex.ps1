Build-DocPredicate `
    -Name 'is_regex' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a valid regular expression' `
    `
    -Examples @'
```
var_dump(is_regex('')); //false
var_dump(is_regex(' ')); //true
var_dump(is_regex('!@#$%')); //true
var_dump(is_regex('.*')); //true
var_dump(is_regex('/.*/')); //true
var_dump(is_regex('//.*/')); //false
```
'@