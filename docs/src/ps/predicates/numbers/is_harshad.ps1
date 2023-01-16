Build-DocPredicate `
    -Name 'is_harshad' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a base 10 harshad number' `
    -Related is_natural `
    `
    -Body @'
A harshad number `n` is a [natural number](#is_natural) that is divisible by the sum of its digits

For example, 21 is a harshad number because:

- It is a natural number
- The sum of it's digits is 3
- 21 is divisible by 3

See: https://oeis.org/A005349
'@ `
    -Examples @'
```
var_dump(is_harshad(0)); //false
var_dump(is_harshad('1')); //true
var_dump(is_harshad(-100)); //false
var_dump(is_harshad(50)); //true
var_dump(is_harshad(54)); //true
var_dump(is_harshad(100.00)); //false
var_dump(is_harshad(100)); //true
```
'@