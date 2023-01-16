Build-DocPredicate `
    -Name 'istarts_with' `
    -Signature '(mixed $needle, $mixed $haystack): bool' `
    -Disclaimer 'Like [`starts_with()`](#starts_with) but case insensitive look ups' `
    -ReturnClause 'This predicate returns true if `$haystack` starts with `$needle` - case insensitive' `
    -Related iends_with, starts_with, icontains `
    `
    -Body @'
The following conditions satisfy 'starts_with'
- `$haystack` is array then first element in array == `$needle`
- `$haystack` is string or numeric then `str_starts_with($haystack, $needle)`
'@ `
    -Examples @'
.string
```
$value = 'aoeuhtns1234';
var_dump(iends_with('1234', $value)); //true
```

.array
```
$value = ['aoeuhtns1234'];
var_dump(iends_with('1234', $value)); //false
var_dump(iends_with('aoeuhtns1234', $value)); //true
```

.number
```
var_dump(iends_with(1234, 98761234)); //true
```
'@