Build-DocPredicate `
    -Name 'is_us_phone' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a valid United States phone number' `
    `
    -Body @'
The following conditions statisfy a 'us phone' format:
- `[2-9]#########` (10 digits starting with any number 2-9)
- `[2-9]## ### ####` (10 digits with spaces between parts)
- `[2-9]##.###.####` (10 digits with decimals between parts)
- `[2-9]##-###-####` (10 digits with hyphens between parts)
- `###-####` (7 digits with hyphens between parts)
- `###.####` (7 digits with decimals between parts)
- `### ####` (7 digits with spaces between parts)
- `#######` (7 digits)
'@ `
    -Examples @'

'@