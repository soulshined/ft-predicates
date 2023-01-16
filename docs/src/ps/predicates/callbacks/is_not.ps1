Build-DocPredicate `
    -Name 'is_not' `
    -Signature '(string | callable $predicate): callable' `
    -ReturnClause 'The returned callable returns true if and only if the predicate returns false literal' `
    `
    -Examples @'
.As a callback

```
$values = [0,1,-2,2,3,4,5,6,'seven','y','n','yes','NO'];
array_filter($values, is_not('is_positive'));
// [0,2,seven,y,n,yes,NO]
```

.Calling explicitly
```
is_not('is_positive', 'is_falsy')('1');
//false
```
'@
