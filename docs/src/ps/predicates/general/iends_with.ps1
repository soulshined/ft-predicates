Build-DocPredicate `
    -Name 'iends_with' `
    -Signature '(mixed $needle, $mixed $haystack): bool' `
    -Disclaimer 'Like [`ends_with()`](#ends_with) but case insensitive look ups' `
    -ReturnClause 'This predicate returns true if `$haystack` ends with `$needle` - case insensitive' `
    -Related ends_with, istarts_with, icontains `
    `
    -Body @'
The following conditions satisfy 'ends_with'
- `$haystack` is array then last element in array == `$needle`
- `$haystack` is string or numeric then `str_ends_with($haystack, $needle)`
'@ `
    -Examples @'
.string
```
$value = 'aoeuhtns1234';
var_dump(istarts_with('aoeu', $value)); //true
```

.array
```
$value = ['aoeuhtns1234'];
var_dump(istarts_with('aoeu', $value)); //false
var_dump(istarts_with('aoeuhtns1234', $value)); //true
```

.number
```
var_dump(istarts_with(9876, 98761234)); //true
```
'@