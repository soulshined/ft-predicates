Build-DocPredicate `
    -Name 'is_nor' `
    -Signature '(string | callable ...$predicate): callable' `
    -ReturnClause 'The returned callable returns true if and only if all the predicates return false literal' `
    -Related is_or `
    `
    -Examples @'
.As a callback

```
$values = [0,1,-2,2,3,4,5,6,'seven','y','n','yes','NO'];
array_filter($values, is_nor('is_positive', 'is_odd', 'is_truthy'));
// [0,-2,seven,n,ON]
```

.Calling explicitly
```
is_nor('is_positive', 'is_falsy')('1');
//false
```
'@
