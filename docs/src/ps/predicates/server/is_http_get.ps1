Build-DocPredicate `
    -Name 'is_http_get' `
    -Signature '(?string $value = null): bool' `
    -ReturnClause 'This predicate returns if `$value` is an HTTP GET request' `
    -Related is_http_method `
    `
    -Body @'
> **Note** If `$value` is null the request method in the global `$_SERVER` variable will be used implicitly
'@ `
    -Examples @'
```
$user_input = 'post';
var_dump(is_http_get($user_input)); //false
```

.array
```
$values = ['abc', 123, 'post', 'conn', 'DELETE', 'GET', 'del'];
var_dump(array_filter($values, 'is_http_get')); // [GET]
```

.assuming the $_SERVER['REQUEST_METHOD'] value is 'GET'
```
var_dump(is_http_get()); //true
```
'@