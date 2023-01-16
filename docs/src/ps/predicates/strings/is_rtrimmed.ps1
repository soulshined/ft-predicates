Build-DocPredicate `
    -Name 'is_rtrimmed' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is not null and the end of `$value` does not contain whitespace' `
    -Related is_ltrimmed, is_trimmed `
    `
    -Examples @'
```
var_dump(is_rtrimmed('aoeuhtns   ')); //false
var_dump(is_rtrimmed(' ')); //false
var_dump(is_rtrimmed('    aoeuhtns   ')); //false
var_dump(is_rtrimmed('    ')); //false
var_dump(is_rtrimmed('    aoeuhtns')); //true
var_dump(is_rtrimmed('')); //true
```
'@