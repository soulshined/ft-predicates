Build-DocPredicate `
    -Name 'is_http_post' `
    -Signature '(?string $value = null): bool' `
    -ReturnClause 'This predicate returns if `$value` is an HTTP POST request' `
    -Related is_http_method `
    `
    -Body @'
> **Note** If `$value` is null the request method in the global `$_SERVER` variable will be used implicitly
'@ `
    -Examples @'
```
$user_input = 'put';
var_dump(is_http_post($user_input)); //false
```

.array
```
$values = ['abc', 123, 'post', 'conn', 'options', 'GET', 'del'];
var_dump(array_filter($values, 'is_http_post')); // [post]
```

.assuming the $_SERVER['REQUEST_METHOD'] value is 'POST'
```
var_dump(is_http_post()); //true
```
'@