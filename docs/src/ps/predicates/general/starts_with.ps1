Build-DocPredicate `
    -Name 'starts_with' `
    -Signature '(mixed $needle, $mixed $haystack): bool' `
    -ReturnClause 'This predicate returns true if `$haystack` starts with `$needle` - case sensitive' `
    -Related iends_with, starts_with, contains `
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
var_dump(starts_with('AOEU', $value)); //false
var_dump(starts_with('aoeu', $value)); //true
```

.array
```
$value = ['aoeuhtns1234'];
var_dump(starts_with('aoeu', $value)); //false
var_dump(starts_with('aoeuhtns1234', $value)); //true
```

.number
```
var_dump(starts_with(9876, 98761234)); //true
```
'@