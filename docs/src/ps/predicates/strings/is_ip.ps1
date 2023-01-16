Build-DocPredicate `
    -Name 'is_ip' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is an ip address as defined by `filter_var()`' `
    -Related is_ipv4, is_ipv6 `
    `
    -Examples @'
```
var_dump(is_ip('127.16.0.0')); //true
var_dump(is_ip('128.66.0.0/16')); //false
var_dump(is_ip('2001:DB8:0:0:8:800:200C:417A')); //true
var_dump(is_ip('0:0:0:0:0:0:0:1')); //true
var_dump(is_ip('FF01::101')); //true
var_dump(is_ip('::')); //true
var_dump(is_ip('::1')); //true
```
'@