Build-DocPredicate `
    -Name 'is_us_state' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a valid Unite States state name or United States state abbreviation' `
    -Related is_us_state_abbr, is_us_state_name, is_us_territory