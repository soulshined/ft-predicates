Build-DocPredicate `
    -Name 'is_perfect' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a perfect number' `
    -Related is_natural `
    `
    -Body @'
A perfect number `n` is a [natural number](#is_natural) that is equal to the sum of the proper divisors of `n`

For example, 28 is a perfect number because:

- It is a natural number
- The sum of all divisors of 28, less than 28 = `1 + 2 + 4 + 7 + 14` = `28`

See: https://oeis.org/A000396
'@