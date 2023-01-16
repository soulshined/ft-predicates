Build-DocPredicate `
    -Name 'is_ltrimmed' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is not null and the start of `$value` does not contain whitespace' `
    -Related is_rtrimmed, is_trimmed `
    `
    -Examples @'
```
var_dump(is_ltrimmed('    aoeuhtns')); //false
var_dump(is_ltrimmed(' ')); //false
var_dump(is_ltrimmed('    aoeuhtns   ')); //false
var_dump(is_ltrimmed('    ')); //false
var_dump(is_ltrimmed('aoeuhtns   ')); //true
var_dump(is_ltrimmed('')); //true
```
'@