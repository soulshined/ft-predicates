Build-DocPredicate `
    -Name 'is_trimmed' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is not null and both `r_trimmed()` and `l_trimmed()`' `
    -Related is_ltrimmed, is_rtrimmed `
    `
    -Examples @'
```
var_dump(is_trimmed('aoeuhtns   ')); //false
var_dump(is_trimmed('     aoeuhtns   ')); //false
var_dump(is_trimmed('     aoeuhtns')); //false
var_dump(is_trimmed(' ')); //false
var_dump(is_trimmed('')); //true
var_dump(is_trimmed('aoeuhtns')); //true
```
'@