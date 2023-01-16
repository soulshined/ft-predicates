Build-DocPredicate `
    -Name 'is_within_date_range' `
    -Signature '(string | DateTimeInterface | null $value, string $relative_format): bool' `
    -ReturnClause 'This predicate returns true if `$value` is within the date range provided compared to `now`' `
    -Tags locale-aware `
    -Related is_future, is_past `
    `
    -Body @'
Identify if a given value is within a specified date range comparing its relative timestamp to `now`

For example:

`is_within_date_range($date, '+-5 mins')`

The expectation in that example is that `$date` should be a date within plus or minus 5 mins of `now`

For example, assume the current time (`now`) is `T16:00 UTC`

```
is_within_date_range('T15:54 UTC', '+-5 mins'); //false because 6 mins ago
is_within_date_range('T15:55 UTC', '+-5 mins'); //true because 5 mins ago
is_within_date_range('T15:56 UTC', '+-5 mins'); //true because 4 mins ago
is_within_date_range('T16:00 UTC', '+-5 mins'); //true because now
is_within_date_range('T16:04 UTC', '+-5 mins'); //true because in 4 mins
is_within_date_range('T16:05 UTC', '+-5 mins'); //true because in 5 mins
is_within_date_range('T16:06 UTC', '+-5 mins'); //false because 1 min over
```

**Plus or Minus Syntax**

> **Important** When a plus or minus symbol is omitted, the default is `-` (in the past)

- `is_within_date_range($date, '+-5 mins')` means `$date` should be + or minus 5 mins from `now`
- `is_within_date_range($date, '-5 mins)` means `$date` should be after 5 mins ago from `now` but not after `now`
- `is_within_date_range($date, '+5 mins)` means `$date` should be between `now` and `now +5 mins`
- `is_within_date_range($date, '-+5 mins')` `-+` is not supported, it must be plus or minus

**Relative Format**

The `$relative_format` parameter is a custom subset of the php relative formats, it's effectively all  daytext and unit symbols with additional support for a `+` or `-` prefix

The complete `$relative_format` regex pattern is as follows:

```
/^
 (\+\-|[\+\-])? //optionally start with plus or minus
 ([0-9]+)  //1 or more numbers
 [ \t]+   //1 or more space or tabs
 (ms|µs|weeks|
    (?:msec|millisecond|µsec|microsecond|usec|sec(ond)?|min(ute)?|hour|day|fortnight|forthnight|month|year|weekday)[s]?
 ) //required unit
$/
```

See: https://www.php.net/manual/en/datetime.formats.relative.php
'@ `
    -Examples @'
```
var_dump(is_within_date_range('-1 min', '+-5 min')); //true
var_dump(is_within_date_range('24 hours', '+-1 weeks')); //true
var_dump(is_within_date_range('+5 hours', '-24 hours')); //false
var_dump(is_within_date_range(new DateTime('last thursday'), '1 weeks')); //true
var_dump(is_within_date_range(new DateTime('last thursday'), '+1 weeks')); //false
var_dump(is_within_date_range(new DateTime('last thursday'), '-1 weeks')); //true
var_dump(is_within_date_range(new DateTime('last thursday'), '+-1 weeks')); //true
```
'@