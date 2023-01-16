Build-DocPredicate `
    -Name 'is_http_method' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a valid HTTP request method' `
    `
    -Body @'
'@ `
    -Examples @'
```
$user_input = 'post';
var_dump(is_http_method($user_input)); //true
```

.array
```
$values = ['abc', 123, 'post', 'conn', 'head', 'GET', 'del'];
var_dump(array_filter($values, 'is_http_method')); // [post, head, GET]
```
'@