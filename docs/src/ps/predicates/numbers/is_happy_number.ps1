Build-DocPredicate `
    -Name 'is_happy_number' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a base 10 happy number' `
    -Related is_natural `
    `
    -Body @'
A happy number `n` is a [natural number](#is_natural) which eventually reaches 1 when replaced by the sum of each digits squares

For example, 23 is a happy number because:

- It is a natural number
- The sum of each digit's square eventually reduces to `1`

```
   2²   +    3²
(2 * 2) + (3 * 3)
   4    +    9     = 13

   1²   +     3²
(1 * 1) + ( 3 * 3 )
   1    +     9    = 10

   1²   +    0²
(1 * 1) + (0 * 0)
   1    +    0
```

See: https://oeis.org/A007770
'@