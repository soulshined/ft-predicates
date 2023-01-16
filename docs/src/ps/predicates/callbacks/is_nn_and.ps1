Build-DocPredicate `
    -Name 'is_nn_and' `
    -Signature '(string | callable ...$predicate): callable' `
    -Disclaimer 'Like [`is_and`](#is_and), ignoring null values by default' `
    -ReturnClause 'The returned callable returns true if and only if all predicates return true literal' `
    -Related is_and `
    `
    -Examples @'
```
$values = [0,1,-2,2,3,4,5,6,null,'seven'];
array_filter($values, is_nn_and('is_scalar', 'is_positive', 'is_even'));
// [2,4,6]
```
'@