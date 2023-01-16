Build-DocPredicate `
    -Name 'icontains' `
    -Signature '(mixed $needle, mixed $haystack): bool' `
    -ReturnClause 'This predicate returns true if `$haystack` contains `$needle` - case insensitive' `
    -Disclaimer 'Like [`contains()`](#contains) but case insensitive lookups where appropriate' `
    -Related contains, iends_with, istarts_with `
    `
    -Body @'
The following conditions satisfy 'contains':

* `$haystack` is array then `in_array($needle, $haystack)`
* `$haystack` is object then `in_array($needle, array_keys(get_object_vars($haystack)))`
* `$needle` is string and `$haystack` is string then `str_contains($haystack, $needle)`
* `$needle` is numeric and `$haystack` is numeric then `str_contains(strval($haystack), strval($needle))`
'@ `
    -Examples @'
.array
```
$values = ['a', 'b', 'c'];
var_dump(icontains('b', $values)); //true
var_dump(icontains('B', $values)); //true
```

.object
```
$obj = new stdClass;
$obj->FOO = "foo";
$obj->BaR = "bar";
var_dump(icontains('BaR', $obj)); //true
var_dump(icontains('foo', $obj)); //true
```

.string
```
$value = "Hello World";
var_dump(icontains("llo", $value)); //true
var_dump(icontains("world", $value)); //true
```

.number
```
$value = "00123.00";
var_dump(icontains(123, $value)); //true
```
'@