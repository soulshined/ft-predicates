Build-DocPredicate `
    -Name 'is_dudeney' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a base 10 dudeney number' `
    `
    -Body @'
A dudeney number `n` is a [natural number](#is_natural) where the sum of its digits is equal to cube root of `n`

For example, 512 is a dudeney number because:

- It is a natural number
- It's cube root is 8
- The sum of it's digits = 5 + 1 + 2 = 8

See: https://oeis.org/A061209
'@