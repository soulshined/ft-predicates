Build-DocPredicate `
    -Name 'is_sum_product' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a sum product number' `
    -Body @'
A sum product number `n` is a [whole number](#is_whole) that the sum of the products of each of `n` digit equals `n`

For example, 144 is a sum product number because:

- It is a whole number
- Each digits product equals the sum of each digit

```
(1 * 4 * 4) =  16
                *
(1 + 4 + 4) =   9
             ----
              144
```
See: https://oeis.org/A038369
'@