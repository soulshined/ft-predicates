Build-DocPredicate `
    -Name 'is_armstrong' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a base 10 armstrong number' `
    -Related is_natural `
    -Tags extn:bcmath `
    `
    -Body @'
An armstrong number `n` is a [natural number](#is_natural) that is the sum of its own digits each raised to the power of the number of digits:

For example, 153 is a natural number because:

- It is a natural number
- There are 3 digits (d<sub>i</sub>) = sum(pow(d<sub>i</sub>, 3)) = n

```
   1         5         3
(1*1*1) + (5*5*5) + (3*3*3) = 153
```
See: https://oeis.org/A005188
'@ `
    -Examples @'
```
var_dump(is_armstrong(-1)); //false
var_dump(is_armstrong(1)); //true
var_dump(is_armstrong(9)); //true
var_dump(is_armstrong(153)); //true
var_dump(is_armstrong(370)); //true
var_dump(is_armstrong(371)); //true
```
'@