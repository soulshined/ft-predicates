Build-DocPredicate `
    -Name 'is_xor' `
    -Signature '(string | callable $apred, string | callable $bpred): callable' `
    -ReturnClause 'The returned callable returns true if and only if any of the predicates return true literal, but not both' `
    -Related is_xnor `
    `
    -Body @'
| P | Q | XOR
|-|-|-|
| T | T | F |
| T | F | T |
| F | T | T |
| F | F | F |
'@ `
    -Examples @'
.As a callable
```
$values = [0,1,-2,2,3,4,5,6,'seven','y','n','yes','NO'];
array_filter($values, is_xor('is_positive', 'is_truthy'));
// [2,3,4,5,6,y,yes]
```
'@