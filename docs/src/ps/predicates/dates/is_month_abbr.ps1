Build-DocPredicate `
    -Name 'is_month_abbr' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a month abbreviation' `
    -Tags locale-aware `
    -Related is_month, is_month_name `
    `
    -Body @'
> **Note** Use's english fallbacks in addition to any translated or supported locale specific values
'@