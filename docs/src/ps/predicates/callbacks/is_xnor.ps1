Build-DocPredicate `
    -Name 'is_xnor' `
    -Signature '(string | callable $apred, string | callable $bpred): callable' `
    -ReturnClause 'The returned callable returns true if and only if both of the predicates return the same value' `
    -Related is_xor `
    `
    -Body @'
| P | Q | XNOR
|-|-|-|
| T | T | T |
| T | F | F |
| F | T | F |
| F | F | T |
'@ `
    -Examples @'
.As a callable
```
$values = [0,1,-2,2,3,4,5,6,'seven','y','n','yes','NO'];
array_filter($values, is_xnor('is_positive', 'is_truthy'));
// [0,1,-2,seven,n,NO]
```
'@