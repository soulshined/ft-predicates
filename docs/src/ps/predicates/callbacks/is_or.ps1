Build-DocPredicate `
    -Name 'is_or' `
    -Signature '(string | callable ...$predicate): callable' `
    -ReturnClause 'The returned callable returns true if any of the predicates return true literal' `
    -Related is_nor `
    `
    -Examples @'
.As a callback

```
$values = [0,1,-2,2,3,4,5,6,'seven','y','n','yes','NO'];
array_filter($values, is_or('is_positive', 'is_odd', 'is_truthy'));
// [1,2,3,4,5,6,y,yes]
```

.Calling explicitly
```
is_or('is_positive', 'is_falsy')('1');
//true
```
'@
