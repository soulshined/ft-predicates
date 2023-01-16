Build-DocPredicate `
    -Name 'is_factorion' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a base 10 factorion number' `
    `
    -Body @'
A factorion number `n` is a [positive number](#is_positive) that is equal to the sum of the factorials of it's digits

For example, 145 is a factorion number because:

- It is a positive number
- Each digit's factorial sums to `n`

```
    1!   +         4!       +           5!
 1( 1 )  +  4( 3 x 2 x 1 )  +  5( 4 x 3 x 2 x 1 )
 1( 1 )  +      4( 6 )      +       5( 24 )
    1    +        24        +         120
```

See: https://oeis.org/A014080
'@