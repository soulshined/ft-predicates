Build-DocPredicate `
    -Name 'is_ipv4' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is an ipv4 address as defined by `filter_var()`' `
    -Related is_ip, is_ipv6 `
    `
    -Body @'

'@ `
    -Examples @'

'@