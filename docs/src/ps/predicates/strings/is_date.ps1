Build-DocPredicate `
    -Name 'is_date' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` can be parsed using `strtotime()`' `
    `
    -Examples @'
```
var_dump(is_date('')); //false
var_dump(is_date(123456890)); //false
var_dump(is_date('   2012-02-01')); //true
var_dump(is_date('2012-02-01')); //true
var_dump(is_date('2012-02-01T00:00Z')); //true
var_dump(is_date('T00:00Z')); //true
```
'@