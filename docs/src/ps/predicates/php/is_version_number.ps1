Build-DocPredicate `
    -Name 'is_version_number' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` matches a PHP version number' `
    `
    -Body @'
The following patterns satisfy a PHP version:
- `#`
- `#.#`
- `#.#.#`
'@ `
    -Examples @'
```
var_dump(is_version_number('5')); //true
var_dump(is_version_number('5.')); //false
var_dump(is_version_number('5.5')); //true
var_dump(is_version_number('5.5.')); //false
var_dump(is_version_number('5.5.5')); //true
var_dump(is_version_number('5.5.5.')); //false
var_dump(is_version_number('10.0.0')); //true
```
'@