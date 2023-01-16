Build-DocPredicate `
    -Name 'is_us_state_name' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a valid Unite States state name' `
    -Related is_us_state, is_us_territory