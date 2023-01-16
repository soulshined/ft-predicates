Build-DocPredicate `
    -Name 'is_palidrome' `
    -Signature '(string | int | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` equals the reverse of `$value`' `
    `
    -Examples @'
```
var_dump(is_palidrome(123454321)); //true
var_dump(is_palidrome('abba')); //true
var_dump(is_palidrome('racecar')); //true
```
'@