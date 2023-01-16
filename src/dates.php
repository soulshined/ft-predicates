<?php

use FT\Predicates\Locale\i18n;

use function FT\Predicates\Deprecation\validate;
use function function_exists as exists;

define('RFC3339_HOUR', 'H');
define('RFC3339_MINUTE', 'i');
define('RFC3339_SECOND', 's');
define('RFC3339_MONTH', 'm');
define('RFC3339_MONTH_DAY', 'd');
define('RFC3339_YEAR', 'Y');
define('RFC3339_FULL_DATE', join("-", [RFC3339_YEAR, RFC3339_MONTH, RFC3339_MONTH_DAY]));

class DateUtils {

    static function create_today(DateTimeZone $tz) : DateTime  {
        return DateUtils::create('today', $tz);
    }
    static function create_yesterday(DateTimeZone $tz) : DateTime  {
        return DateUtils::create('yesterday', $tz);
    }
    static function create_tomorrow(DateTimeZone $tz) : DateTime  {
        return DateUtils::create('tomorrow', $tz);
    }
    static function get_tz(mixed $date)   {
        if ($date instanceof DateTimeInterface)
            return $date->getTimezone() ?: i18n::getTimezone()->toDateTimeZone();

        return i18n::getTimezone()->toDateTimeZone();
    }

    static function create(string | DateTimeInterface | null $date, DateTimeZone $timezone) : DateTime | false {
        if (is_null($date) || is_string($date) && !is_date($date)) return false;

        if (is_string($date))
            $date = new DateTime($date, $timezone);
        else
            $date = DateTime::createFromInterface($date);

        $errors = DateTime::getLastErrors();
        if ($errors === false) return $date;

        if ($errors['warning_count'] === 0 &&
            $errors['error_count'] === 0) return $date;

        return false;
    }

    static function normalize(string | DateTimeInterface $value, string $format) {
        if (is_string($value)) return $value;

        return $value->format($format);
    }

    static function dates_equal($a_rfc3339, $b_rfc3339) : bool {
        return $a_rfc3339->year === $b_rfc3339->year &&
               $a_rfc3339->month === $b_rfc3339->month &&
               $a_rfc3339->month_date === $b_rfc3339->month_date;
    }

    static function get_rfc3339_full_date(DateTimeInterface $date): object {
        $std = new stdClass;
        $std->year = (int) $date->format(RFC3339_YEAR);
        $std->month = (int) $date->format(RFC3339_MONTH);
        $std->month_date = (int) $date->format(RFC3339_MONTH_DAY);
        $std->hour = (int) $date->format(RFC3339_HOUR);
        $std->minute = (int) $date->format(RFC3339_MINUTE);
        $std->second = (int) $date->format(RFC3339_SECOND);
        return $std;
    }

}

foreach ([
    'is_dayofweek',
    'is_weekday',
    'is_weekend_day',
    'is_month',
    'is_month_name',
    'is_month_abbr',
    'is_yesterday',
    'is_tomorrow',
    'is_today',
    'is_last_month',
    'is_next_month',
    'is_this_month',
    'is_this_quarter',
    'is_last_quarter',
    'is_next_quarter',
    'is_leap_year',
    'is_this_year',
    'is_next_year',
    'is_last_year',
    'is_past',
    'is_future',
    'is_am',
    'is_pm',
    'is_noon',
    'is_midnight',
    'is_evening',
    'is_morning',
    'is_afternoon',
    'is_within_date_range',
    'is_end_of_month',
    'is_start_of_month',
    'is_us_holiday'
] as $fn) { validate($fn); }

if (!exists('is_dayofweek')) {
    /**
     * @return true if `$value` is a locale-aware day of week name or day of week abbreviation or local-aware day of week number
     */
    function is_dayofweek(?string $value) : bool {
        if (is_null($value)) return false;

        return in_array(
            strtolower($value),
            array_merge(
                i18n::getWeekdayNames(),
                i18n::getWeekenddayNames(),
                i18n::getWeekdayAbbrs(),
                i18n::getWeekenddayAbbrs(),
                i18n::getWeekdayDigits(),
                i18n::getWeekenddayDigits()
            )
        );
    }
}

if (!exists('is_weekday')) {
    /**
     * @param string | DateTimeInterface | null $value If a string is provided it is first validated if it's numeric and a weekday digit, else it's raw value is used, or the current timestamp when `$value` is null
     *
     * @return true if `$value` is a locale-aware week day name or locale-aware week day abbreviation or locale-aware week day number
     */
    function is_weekday(string | DateTimeInterface | null $value = null) : bool
    {
        if (is_numeric($value))
            return in_array($value, i18n::getWeekdayDigits());

        $tz = DateUtils::get_tz($value);
        if (is_null($value)) $value = DateUtils::create('now', $tz);

        return in_array(
            strtolower(DateUtils::normalize($value, "l")),
            array_merge(
                i18n::getWeekdayNames(),
                i18n::getWeekdayAbbrs()
            )
        );
    }
}

if (!exists('is_weekend_day')) {
    /**
     * @param string | DateTimeInterface | null $value If a string is provided it is first validated if it's numeric and a weekday digit, else it's raw value is used, or the current timestamp when `$value` is null
     *
     * @return true if `$value` is a locale-aware weekend day name or locale-aware weekend day abbreviation or locale-aware weekend day number
     */
    function is_weekend_day(string | DateTimeInterface | null $value = null) : bool {
        if (is_numeric($value))
            return in_array(strval($value), i18n::getWeekenddayDigits());

        $tz = DateUtils::get_tz($value);
        if (is_null($value)) $value = DateUtils::create('now', $tz);

        return in_array(strtolower(DateUtils::normalize($value, "l")), array_merge(
            i18n::getWeekenddayAbbrs(),
            i18n::getWeekenddayNames()
        ));
    }
}

if (!exists('is_month')) {
    /**
     * @return true if `$value` is a locale-aware month name or locale-aware month abbreviation or month number (0?1-12)
     */
    function is_month(string | int | null $value) : bool
    {
        if (is_null($value)) return false;
        if (is_month_abbr($value) || is_month_name($value)) return true;

        return preg_match("/^([0]?[1-9]|1[0-2])$/", strval($value), $matches) === 1;
    }
}

if (!exists('is_month_name')) {
    /**
     * return true if `$value` is a locale-aware month name
     */
    function is_month_name(?string $value) : bool
    {
        if (is_null($value)) return false;

        return in_array(strtolower($value), i18n::getMonthNames());
    }
}

if (!exists('is_month_abbr')) {
    /**
     * @return true if `$value` is a locale-aware month abbreviation
     */
    function is_month_abbr(?string $value) : bool
    {
        if (is_null($value)) return false;

        return in_array(strtolower($value), i18n::getMonthAbbrs());
    }
}

if (!exists('is_yesterday')) {
    /**
     * @return true if `$value` is yesterday
     */
    function is_yesterday(string | DateTimeInterface | null $value) : bool {
        if (is_null($value)) return false;

        $tz = DateUtils::get_tz($value);

        $yesterday_date = DateUtils::create_yesterday($tz);
        $yesterday_info = DateUtils::get_rfc3339_full_date($yesterday_date);

        if (is_numeric($value))
            return $yesterday_info->month_date == $value;
        else if (is_string($value) && is_dayofweek($value)) {
            $value = strtolower($value);
            $yesterday = i18n::getDayInfo($yesterday_date->format('l'));

            return !is_null($yesterday) &&
                    (
                        $yesterday['element']->identifier === $value ||
                        $yesterday['element']->abbr?->identifier === $value ||
                        $yesterday['translation'] === $value
                    );
        }

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        return DateUtils::dates_equal(DateUtils::get_rfc3339_full_date($value), $yesterday_info);
    }
}

if (!exists('is_tomorrow')) {
    /**
     * @return true if `$value` is tomorrow
     */
    function is_tomorrow(string | DateTimeInterface | null $value) : bool
    {
        if (is_null($value)) return false;

        $tz = DateUtils::get_tz($value);

        $tomorrow_date = DateUtils::create_tomorrow($tz);
        $tomorrow_info = DateUtils::get_rfc3339_full_date($tomorrow_date);

        if (is_numeric($value))
            return $tomorrow_info->month_date == $value;
        else if (is_string($value) && is_dayofweek($value)) {
            $value = strtolower($value);
            $tomorrow = i18n::getDayInfo($tomorrow_date->format('l'));

            return !is_null($tomorrow) &&
                    (
                        $tomorrow['element']->identifier === $value ||
                        $tomorrow['element']->abbr?->identifier === $value ||
                        $tomorrow['translation'] === $value
                    );
        }

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        return DateUtils::dates_equal(DateUtils::get_rfc3339_full_date($value), $tomorrow_info);
    }
}

if (!exists('is_today')) {
    /**
     * @return true if `$value` is today
     */
    function is_today(string | DateTimeInterface | null $value) : bool
    {
        if (is_null($value)) return false;

        $tz = DateUtils::get_tz($value);

        $today_date = DateUtils::create_today($tz);
        $today_info = DateUtils::get_rfc3339_full_date($today_date);

        if (is_numeric($value))
            return $today_info->month_date == $value;
        else if (is_string($value) && is_dayofweek($value)) {
            $value = strtolower($value);
            $today = i18n::getDayInfo($today_date->format('l'));

            return !is_null($today) &&
                    (
                        $today['element']->identifier === $value ||
                        $today['element']->abbr?->identifier === $value ||
                        $today['translation'] === $value
                    );
        }

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        return DateUtils::dates_equal(DateUtils::get_rfc3339_full_date($value), $today_info);
    }
}

if (!exists('is_last_month')) {
    /**
     * @return true if `$value` falls within last month
     */
    function is_last_month(string | DateTimeInterface | null $value) : bool
    {
        if (is_null($value)) return false;

        $tz = DateUtils::get_tz($value);

        $last_month_date = new DateTime('first day of last month', $tz);
        $last_month_info = DateUtils::get_rfc3339_full_date($last_month_date);

        if (is_string($value)) {
            if (is_numeric($value))
                return $last_month_info->month == $value;
            else if (is_month($value)) {
                $value = strtolower($value);
                $month = i18n::getMonthInfo($last_month_date->format('F'));

                return !is_null($month) &&
                        (
                            $month['element']->identifier === $value ||
                            $month['element']->abbr?->identifier === $value ||
                            $month['translation'] === $value
                        );
            }
        }

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        $value_info = DateUtils::get_rfc3339_full_date($value);

        if ($value_info->month !== $last_month_info->month) return false;

        $today = DateUtils::get_rfc3339_full_date(DateUtils::create_today($tz));

        if ($today->month === 1)
            return $today->year - 1 === $value_info->year;

        return $today->year === $value_info->year;
    }
}

if (!exists('is_next_month')) {
    /**
     * @return true if `$value` falls within next month
     */
    function is_next_month(string | DateTimeInterface | null $value) : bool
    {
        if (is_null($value)) return false;

        $tz = DateUtils::get_tz($value);

        $next_month_date = new DateTime('first day of next month', $tz);
        $next_month_info = DateUtils::get_rfc3339_full_date($next_month_date);

        if (is_string($value)) {
            if (is_numeric($value))
                return $next_month_info->month == $value;
            else if (is_month($value)) {
                $value = strtolower($value);
                $month = i18n::getMonthInfo($next_month_date->format('F'));

                return !is_null($month) &&
                        (
                            $month['element']->identifier === $value ||
                            $month['element']->abbr?->identifier === $value ||
                            $month['translation'] === $value
                        );
            }
        }

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        $value_info = DateUtils::get_rfc3339_full_date($value);

        if ($value_info->month !== $next_month_info->month) return false;

        $today = DateUtils::get_rfc3339_full_date(DateUtils::create_today($tz));

        if ($today->month === 12)
            return $today->year + 1 === $value_info->year;

        return $today->year === $value_info->year;
    }
}

if (!exists('is_this_month')) {
    /**
     * @return true if `$value` falls within this month
     */
    function is_this_month(string | DateTimeInterface | null $value) : bool
    {
        if (is_null($value)) return false;

        $tz = DateUtils::get_tz($value);

        $today_date = DateUtils::create_today($tz);
        $today_info = DateUtils::get_rfc3339_full_date($today_date);

        if (is_string($value)) {
            if (is_numeric($value))
                return $today_info->month == $value;
            else if (is_month($value)) {
                $value = strtolower($value);
                $month = i18n::getMonthInfo($today_date->format('F'));

                return !is_null($month) &&
                        (
                            $month['element']->identifier === $value ||
                            $month['element']->abbr?->identifier === $value ||
                            $month['translation'] === $value
                        );
            }
        }

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        $value_info = DateUtils::get_rfc3339_full_date($value);

        return $value_info->month === $today_info->month && $value_info->year === $today_info->year;
    }
}

if (!exists('is_next_quarter')) {
    /**
     * @return true if `$value` falls within the next quarter, cycling
     */
    function is_next_quarter(string | DateTimeInterface | null $value) : bool {
        if (is_null($value)) return false;

        $tz = DateUtils::get_tz($value);

        $today_date = DateUtils::create_today($tz);
        $today_quarter = (int) i18n::getDateFormatter()->formatObject($today_date, 'qqqqq');
        $next_quarter = $today_quarter === 4 ? 1 : $today_quarter + 1;

        if (is_numeric($value)) return $value == $next_quarter;

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        $value_quarter = (int) i18n::getDateFormatter()->formatObject($value, 'qqqqq');

        if ($value_quarter !== $next_quarter) return false;

        $value_info = DateUtils::get_rfc3339_full_date($value);
        $today_info = DateUtils::get_rfc3339_full_date($today_date);

        if ($today_info->month >= 10 and $today_info->month <= 12)
            return $today_info->year + 1 === $value_info->year;

        return $today_info->year === $value_info->year;
    }
}

if (!exists('is_last_quarter')) {
    /**
     * @return true if `$value` falls within the last quarter, cycling
     */
    function is_last_quarter(string | DateTimeInterface | null $value) : bool {
        if (is_null($value)) return false;

        $tz = DateUtils::get_tz($value);

        $today_date = DateUtils::create_today($tz);
        $today_quarter = (int) i18n::getDateFormatter()->formatObject($today_date, 'qqqqq');
        $last_quarter = $today_quarter === 1 ? 4 : $today_quarter - 1;

        if (is_numeric($value)) return $value == $last_quarter;

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        $value_quarter = (int) i18n::getDateFormatter()->formatObject($value, 'qqqqq');

        if ($value_quarter !== $last_quarter) return false;

        $value_info = DateUtils::get_rfc3339_full_date($value);
        $today_info = DateUtils::get_rfc3339_full_date($today_date);

        if ($today_info->month >= 1 and $today_info->month <= 3)
            return $today_info->year - 1 === $value_info->year;

        return $today_info->year === $value_info->year;
    }
}

if (!exists('is_this_quarter')) {
    /**
     * @return true if `$value` falls within this quarter
     */
    function is_this_quarter(string | DateTimeInterface | null $value) : bool
    {
        if (is_null($value)) return false;

        $tz = DateUtils::get_tz($value);
        $today_date = DateUtils::create_today($tz);
        $today_quarter = (int) i18n::getDateFormatter()->formatObject($today_date, 'qqqqq');

        if (is_numeric($value)) return $value == $today_quarter;

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        $value_quarter = (int) i18n::getDateFormatter()->formatObject($value, 'qqqqq');

        $value_info = DateUtils::get_rfc3339_full_date($value);
        $today_info = DateUtils::get_rfc3339_full_date($today_date);

        return $today_quarter === $value_quarter && $value_info->year === $today_info->year;
    }
}

if (!exists('is_leap_year')) {
    /**
     * @param string | DateTimeInterface | null $value When `$value` is null the current timestamp is used
     *
     * @return true if `$value` is a locale-aware leap year
     */
    function is_leap_year(string | DateTimeInterface | null $value = null) : bool
    {
        $tz = DateUtils::get_tz($value);
        if (is_null($value)) $value = new DateTime('now', $tz);

        if (!is_numeric($value)) {
            $value = DateUtils::create($value, $tz);
            if ($value === false) return false;

            $value = $value->format(RFC3339_YEAR);
        }

        return IntlGregorianCalendar::createInstance( $tz )->isLeapYear($value);
    }
}

if (!exists('is_this_year')) {
    /**
     * @return true if `$value` falls within this year
     */
    function is_this_year(string | DateTimeInterface | null $value) : bool {
        if (is_null($value)) return false;

        $tz = DateUtils::get_tz($value);
        $today_date = DateUtils::create_today($tz);
        $today_year = $today_date->format(RFC3339_YEAR);

        if (is_numeric($value)) return $today_year == $value;

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        return $value->format(RFC3339_YEAR) === $today_year;
    }
}

if (!exists('is_next_year')) {
    /**
     * @return true if `$value` falls within next year
     */
    function is_next_year(string | DateTimeInterface | null $value) : bool {
        if (is_null($value)) return false;

        $tz = DateUtils::get_tz($value);
        $next_year_date = new DateTime('first day of next year', $tz);
        $next_year = $next_year_date->format(RFC3339_YEAR);

        if (is_numeric($value)) return $next_year == $value;

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        return $next_year === $value->format(RFC3339_YEAR);
    }
}

if (!exists('is_last_year')) {
    /**
     * @return true if `$value` falls within last year
     */
    function is_last_year(string | DateTimeInterface | null $value) : bool {
        if (is_null($value)) return false;

        $tz = DateUtils::get_tz($value);
        $last_year_date = new DateTime('first day of last year', $tz);
        $last_year = $last_year_date->format(RFC3339_YEAR);

        if (is_numeric($value)) return $last_year == $value;

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        return $last_year === $value->format(RFC3339_YEAR);
    }
}

if (!exists('is_past')) {
    /**
     * @return true if `$value` is in the past
     */
    function is_past(string | DateTimeInterface | null $value) : bool {
        if (is_null($value)) return false;

        $tz = DateUtils::get_tz($value);

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        $now = new DateTime('now', $tz);

        return $value->getTimestamp() < $now->getTimestamp();
    }
}

if (!exists('is_future')) {
    /**
     * @return true if `$value` is in the future
     */
    function is_future(string | DateTimeInterface | null $value) : bool {
        if (is_null($value)) return false;

        $tz = DateUtils::get_tz($value);

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        $now = new DateTime('now', $tz);

        return $value->getTimestamp() > $now->getTimestamp();
    }
}

if (!exists('is_am')) {
    /**
     * @param string | DateTimeInterface | null $value When `$value` is null the current timestamp is used
     *
     * @return true if `$value` has a meridiem value of am
     */
    function is_am(string | DateTimeInterface | null $value = null) : bool {
        $tz = DateUtils::get_tz($value);
        if (is_null($value)) $value = new DateTime('now', $tz);

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        return $value->format('a') === i18n::_('am');
    }
}

if (!exists('is_pm')) {
    /**
     * @param string | DateTimeInterface | null $value When `$value` is null the current timestamp is used
     *
     * @return true if `$value` has a meridiem value of pm
     */
    function is_pm(string | DateTimeInterface | null $value = null) : bool {
        $tz = DateUtils::get_tz($value);
        if (is_null($value)) $value = new DateTime('now', $tz);

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        return $value->format('a') === i18n::_('pm');
    }
}

if (!exists('is_noon')) {
    /**
     * @param string | DateTimeInterface | null $value When `$value` is null the current timestamp is used
     *
     * @return true if `$value` has a meridiem value of 'noon'. Not all locales have this idiom
     *
     * @see https://www.unicode.org/reports/tr35/tr35-dates.html#Day_Period_Rules
     */
    function is_noon(string | DateTimeInterface | null $value = null) : bool
    {
        $tz = DateUtils::get_tz($value);
        if (is_null($value)) $value = new DateTime('now', $tz);

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        $meridiem = i18n::getDateFormatter()->formatObject($value, 'bbbb');
        return strtolower($meridiem) == i18n::_('noon');
    }
}

if (!exists('is_midnight')) {
    /**
     * @param string | DateTimeInterface | null $value When `$value` is null the current timestamp is used
     *
     * @return true if `$value` is midnight (either 24:00 or 00:00)
     */
    function is_midnight(string | DateTimeInterface | null $value = null) : bool
    {
        $tz = DateUtils::get_tz($value);
        if (is_null($value)) $value = new DateTime('now', $tz);
        if (is_string($value) && is_date($value) &&
            str_contains($value, '24:00')) return true;

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        $value_info = DateUtils::get_rfc3339_full_date($value);
        return $value_info->hour === 0 && $value_info->minute === 0;
    }
}

if (!exists('is_evening')) {
    /**
     * @param string | DateTimeInterface | null $value When `$value` is null the current timestamp is used
     *
     * @return true if `$value` has a locale-aware period of 'evening'. Not all locales have this idiom
     *
     * @see https://unicode-org.github.io/cldr-staging/charts/38/supplemental/day_periods.html
     */
    function is_evening(string | DateTimeInterface | null $value = null) : bool {
        $tz = DateUtils::get_tz($value);
        if (is_null($value)) $value = new DateTime('now', $tz);

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        $meridiem = i18n::getDateFormatter()->formatObject($value, 'BBBB');
        return str_contains(strtolower($meridiem), i18n::_('evening'));
    }
}

if (!exists('is_morning')) {
    /**
     * @param string | DateTimeInterface | null $value When `$value` is null the current timestamp is used
     *
     * @return true if `$value` has a locale-aware period of 'morning'. Not all locales have this idiom
     *
     * @see https://unicode-org.github.io/cldr-staging/charts/38/supplemental/day_periods.html
     */
    function is_morning(string | DateTimeInterface | null $value = null) : bool {
        $tz = DateUtils::get_tz($value);
        if (is_null($value)) $value = new DateTime('now', $tz);

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        $meridiem = i18n::getDateFormatter()->formatObject($value, 'BBBB');
        return str_contains(strtolower($meridiem), i18n::_('morning'));
    }
}

if (!exists('is_afternoon')) {
    /**
     * @param string | DateTimeInterface | null $value When `$value` is null the current timestamp is used
     *
     * @return true if `$value` has a locale-aware period of 'afternoon'. Not all locales have this idiom
     *
     * @see https://unicode-org.github.io/cldr-staging/charts/38/supplemental/day_periods.html
     */
    function is_afternoon(string | DateTimeInterface | null $value = null) : bool {
        $tz = DateUtils::get_tz($value);
        if (is_null($value)) $value = new DateTime('now', $tz);

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        $meridiem = i18n::getDateFormatter()->formatObject($value, 'BBBB');
        return str_contains(strtolower($meridiem), i18n::_('noon'));
    }
}

if (!exists('is_within_date_range')) {
    /**
     * Identify if a given value is within a specified date range comparing its relative timestamp to `now` timestamp
     *
     * Examples:
     * - `is_within_date_range($date, '+-5 mins')` means `$date` should be + or minus 5 mins from `now`
     * - `is_within_date_range($date, '-5 mins)` means `$date` should be after 5 mins ago from `now` but not after `now`
     * - `is_within_date_range($date, '+5 mins)` means `$date` should be between `now` and `now +5 mins`
     * - `is_within_date_range($date, '5 mins)` (omission of symbol defaults to `-`)
     *
     * @param string $relative_format a subset of relative formats with an added `+-` symbol to indicate plus or minus
     *
     * @return true if `$value` is within the date range provided compared to `now`
     * For example `is_within_date_range($date, '+-5 mins')` should be a date within 5 mins of now, in the future or past
     *
     * @see https://www.php.net/manual/en/datetime.formats.relative.php
     */
    function is_within_date_range(string | DateTimeInterface | null $value, string $relative_format) : bool {
        if (is_null($value)) return false;

        $tz = DateUtils::get_tz($value);
        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        if (!preg_match("/^(\+\-|[\+\-])?([0-9]+)[ \t]+(ms|µs|weeks|(?:msec|millisecond|µsec|microsecond|usec|sec(ond)?|min(ute)?|hour|day|fortnight|forthnight|month|year|weekday)[s]?)$/", $relative_format, $match, PREG_UNMATCHED_AS_NULL))
            return false;

        [$_, $relative_symbol, $quantity, $unit] = $match;

        if (is_null($relative_symbol)) $relative_symbol = '-';

        $now = (new DateTime('now', $tz))->getTimestamp();
        $timestamp = $value->getTimestamp();

        if ($relative_symbol === '+-') {
            $lower = new DateTime("-$quantity $unit", $tz);
            $upper = new DateTime("+$quantity $unit", $tz);

            return $lower->getTimestamp() <= $value->getTimestamp() && $value->getTimestamp() <= $upper->getTimestamp();
        }
        else if ($relative_symbol === '-' && $timestamp <= $now) {
            $lower = new DateTime("-$quantity $unit", $tz);

            return $timestamp >= $lower->getTimestamp();
        }
        else if ($relative_symbol === '+' && $timestamp >= $now) {
            $upper = new DateTime("+$quantity $unit", $tz);

            return $value->getTimestamp() <= $upper->getTimestamp();
        }

        return false;
    }
}

if (!exists('is_end_of_month')) {
    /**
     * @param string | DateTimeInterface | null $value When `$value` is null the current timestamp is used
     *
     * @return true if `$value` is greater than or equal to the last half of the `$value` month
     */
    function is_end_of_month(string | DateTimeInterface | null $value = null) : bool {
        $tz = DateUtils::get_tz($value);
        if (is_null($value)) $value = new DateTime('now', $tz);

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        $max_days = i18n::getCalendar()->fromDateTime($value, null)->getActualMaximum(IntlCalendar::FIELD_DATE);
        return $value->format(RFC3339_MONTH_DAY) >= floor($max_days / 2);
    }
}

if (!exists('is_start_of_month')) {
    /**
     * @param string | DateTimeInterface | null $value When `$value` is null the current timestamp is used
     *
     * @return true if `$value` is less than or equal to the first half of the `$value` month
     */
    function is_start_of_month(string | DateTimeInterface | null $value = null) : bool  {
        $tz = DateUtils::get_tz($value);
        if (is_null($value)) $value = new DateTime('now', $tz);

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        $max_days = i18n::getCalendar()->fromDateTime($value, null)->getActualMaximum(IntlCalendar::FIELD_DATE);
        return $value->format(RFC3339_MONTH_DAY) <= floor($max_days / 2);
    }
}

if (!exists('is_us_holiday')) {
    /**
     * This method accounts for when the holiday was established. For example, if the date is `Jan 1st 1869`, it will not be New Years since the holiday was established in 1870
     *
     * @param string | DateTimeInterface | null $value When `$value` is null the current timestamp is used
     *
     * @return true if `$value` lands on a fixed or observed us holiday for `$value`'s year
     */
    function is_us_holiday(string | DateTimeInterface | null $value = null) : bool
    {
        $tz = DateUtils::get_tz($value);
        if (is_null($value)) $value = new DateTime('now', $tz);

        $value = DateUtils::create($value, $tz);
        if ($value === false) return false;

        $fd = DateUtils::get_rfc3339_full_date($value);

        $holidays_for_month = [];

        if ($fd->month == 1) {
            //New Years
            if ($fd->year >= 1870) $holidays_for_month[] = 1;
            //MLK Birthday
            if ($fd->year >= 1983)
                $holidays_for_month[] = (new DateTime("third monday of january $fd->year"))->format(RFC3339_MONTH_DAY);
        }
        else if ($fd->month == 2) {
            if ($fd->year >= 1879)
                $holidays_for_month[] = (new DateTime("third monday of february $fd->year"))->format(RFC3339_MONTH_DAY);
        }
        else if ($fd->month == 5) {
            //memorial day
            if ($fd->year >= 1971)
                $holidays_for_month[] = (new DateTime("last monday of may $fd->year"))->format(RFC3339_MONTH_DAY);
        }
        else if ($fd->month == 6) {
            if ($fd->year >= 2021)
                $holidays_for_month[] = 19;
        }
        else if ($fd->month == 7) {
            if ($fd->year >= 1870)
                $holidays_for_month[] = 4;
        }
        else if ($fd->month == 9) {
            //labor day
            if ($fd->year >= 1894)
                $holidays_for_month[] = (new DateTime("first monday of september $fd->year"))->format(RFC3339_MONTH_DAY);
        }
        else if ($fd->month == 10) {
            //Columbus day
            if ($fd->year >= 1968)
                $holidays_for_month[] = (new DateTime("second monday of october $fd->year"))->format(RFC3339_MONTH_DAY);
        }
        else if ($fd->month == 11) {
            if ($fd->year >= 1938)
                $holidays_for_month[] =  11;

            //Thanksgiving
            if ($fd->year >= 1941)
                $holidays_for_month[] = (new DateTime("fourth thursday of november $fd->year"))->format(RFC3339_MONTH_DAY);
        }
        else if ($fd->month == 12) {
            if ($fd->year >= 1870)
                $holidays_for_month[] = 25;
        }

        return !empty($holidays_for_month) && in_array($fd->month_date, $holidays_for_month);
    }
}