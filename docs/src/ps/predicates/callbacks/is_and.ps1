Build-DocPredicate `
    -Name "is_and" `
    -Signature '(string | callable ...$predicate): callable' `
    -ReturnClause 'The returned callable returns true if and only if all predicates return true literal' `
    -Related is_nn_and, is_nand `
    -Examples @'
.As a callback

```
$values = [0,1,-2,2,3,4,5,6,'seven'];
array_filter($values, is_and('is_scalar', 'is_positive', 'is_even'));
// [2,4,6]
```

.Calling explicitly
```
is_and('is_positive', 'is_truthy', is_not('is_even'))('1');
//true
```

.Using mixture of supported types
```
is_and('is_positive', fn (`$i) => `$i != 2, is_not('is_odd'))(4);
//true
```
'@ `
