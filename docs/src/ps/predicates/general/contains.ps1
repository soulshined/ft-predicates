Build-DocPredicate `
    -Name 'contains' `
    -Signature '(mixed $needle, mixed $haystack): bool' `
    -ReturnClause 'This predicate returns true if `$haystack` contains `$needle` - case sensitive' `
    -Related icontains, ends_with, starts_with `
    `
    -Body @'
The following conditions satisfy 'contains':

* `$haystack` is array then `in_array($needle, $haystack)`
* `$haystack` is object then `in_array($needle, array_keys(get_object_vars($haystack)))`
* `$needle` is string and `$haystack` is string then `str_contains($haystack, $needle)``
* `$needle` is numeric and `$haystack` is numeric then `str_contains(strval($haystack), strval($needle))`
'@ `
    -Examples @'
.array
```
$values = ['a', 'b', 'c'];
var_dump(contains('b', $values)); //true
var_dump(contains('B', $values)); //false
```

.object
```
$obj = new stdClass;
$obj->FOO = "foo";
$obj->BaR = "bar";
var_dump(contains('BaR', $obj)); //true
var_dump(contains('foo', $obj)); //false
```

.string
```
$value = "Hello World";
var_dump(contains("llo", $value)); //true
var_dump(contains("world", $value)); //false
```

.number
```
$value = "00123.00";
var_dump(contains(123, $value)); //true
```
'@