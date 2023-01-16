Build-DocPredicate `
    -Name 'is_ipv6' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is an ipv6 address as defined by `filter_var()`' `
    -Related is_ip, is_ipv4 `
    `
    -Body @'

'@ `
    -Examples @'

'@