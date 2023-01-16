Build-DocPredicate `
    -Name 'is_us_territory' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a valid United States territory name' `
    -Related is_us_state_abbr, is_us_state `
    `
    -Body @'

'@ `
    -Examples @'

'@