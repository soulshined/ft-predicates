Build-DocPredicate `
    -Name 'is_prime' `
    -Signature '(string | int | float | null $value): bool' `
    -ReturnClause 'This predicate returns true if the provided value is a positive integer, or a numeric string without decimals and is not an e-notated number/numeric string' `
    `
    -Body @'
> **Note** This method will first attempt to use built-in functions if they exist (bcmath, gmp)

See: https://oeis.org/A000040
'@