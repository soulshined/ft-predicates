Build-DocPredicate `
    -Name 'is_nand' `
    -Signature '(string | callable ...$predicate): callable' `
    -ReturnClause 'The returned callable returns true if and only if at least one predicate does not return true literal' `
    -Related is_nn_and, is_and `
    `
    -Examples @'
.As a callback

```
$values = [0,1,-2,2,3,4,5,6,'seven'];
array_filter($values, is_nand('is_positive', 'is_odd'));
// [0,-2,2,4,6,'seven']
```

.Calling explicitly
```
is_nand('is_positive', 'is_falsy')('1');
//true
```

.Using mixture of supported types
```
is_nand('is_positive', fn (`$i) => `$i == 2)(4);
//true
```
'@
