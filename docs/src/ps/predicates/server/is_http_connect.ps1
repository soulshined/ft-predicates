Build-DocPredicate `
    -Name 'is_http_connect' `
    -Signature '(?string $value = null): bool' `
    -ReturnClause 'This predicate returns if `$value` is an HTTP CONNECT request' `
    -Related is_http_method `
    `
    -Body @'
> **Note** If `$value` is null the request method in the global `$_SERVER` variable will be used implicitly
'@ `
    -Examples @'
```
$user_input = 'post';
var_dump(is_http_connect($user_input)); //false
```

.array
```
$values = ['abc', 123, 'post', 'conn', 'connect', 'GET'];
var_dump(array_filter($values, 'is_http_connect')); // [connect]
```

.assuming the $_SERVER['REQUEST_METHOD'] value is 'CONNECT'
```
var_dump(is_http_connect()); //true
```
'@