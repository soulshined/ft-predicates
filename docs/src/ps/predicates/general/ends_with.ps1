Build-DocPredicate `
    -Name 'ends_with' `
    -Signature '(mixed $needle, $mixed $haystack): bool' `
    -ReturnClause 'This predicate returns true if `$haystack` ends with `$needle` - case sensitive' `
    -Related iends_with, starts_with, contains `
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
var_dump(ends_with('1234', $value)); //true
```

.array
```
$value = ['aoeuhtns1234'];
var_dump(ends_with('1234', $value)); //false
var_dump(ends_with('aoeuhtns1234', $value)); //true
```

.number
```
var_dump(ends_with(1234, 98761234)); //true
```
'@