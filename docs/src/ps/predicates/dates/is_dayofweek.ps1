Build-DocPredicate `
    -Name 'is_dayofweek' `
    -Signature '(?string $value): bool' `
    -ReturnClause 'This predicate returns true if `$value` is a day of week name or day of week abbreviation or day of week number' `
    -Tags locale-aware `
    -Related is_weekday, is_weekend_day `
    -Body @'
> **Important** Not every locale has an english counterpart

It would not necessarily be locale-aware to include english versions of days of week as fallbacks. It is a decision made to honor whatever the `IntlCalendar` considers a weekday for the given region and locale and nothing else.

An example of this is given below with the locale of `de_DE`.

_English fallbacks would be the responsibility of the consumer of this package_
'@ `
    -Examples @'
```
var_dump(is_dayofweek('monday')); //true
var_dump(is_dayofweek('tue')); //true
var_dump(is_dayofweek(0)); //false
var_dump(is_dayofweek(1)); //true
var_dump(is_dayofweek(7)); //true
```

.emulating `kr_KR` locale
```
var_dump(is_dayofweek('monday')); //true
var_dump(is_dayofweek('월요일')); //true
var_dump(is_dayofweek(0)); //false
var_dump(is_dayofweek(1)); //true
var_dump(is_dayofweek(7)); //true
```

.emulating `de_DE` locale
```
var_dump(is_dayofweek('monday')); //false
var_dump(is_dayofweek('월요일')); //false
var_dump(is_dayofweek('montag')); //true
var_dump(is_dayofweek(0)); //false
var_dump(is_dayofweek(1)); //true
var_dump(is_dayofweek(7)); //true
```
'@