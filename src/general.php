<?php

use FT\Predicates\Locale\i18n;
use FT\Predicates\Locale\i18nNumber;
use FT\Predicates\Locale\i18nString;

use function FT\Predicates\Deprecation\validate;
use function function_exists as exists;

foreach ([
    'is_false',
    'is_not_false',
    'is_falsy',
    'is_true',
    'is_not_true',
    'is_truthy',
    'is_non_null',
    'is_empty',
    'contains',
    'icontains',
    'is_palidrome',
    'ends_with',
    'iends_with',
    'starts_with',
    'istarts_with',
] as $fn) { validate($fn); }

if (!exists('is_false')) {
    /**
     * @return true if the value is `false` literal
     */
    function is_false(mixed $value) : bool {
        return $value === false;
    }
}

if (!exists('is_not_false')) {
    /**
     * @return true if the value is anything but literal `false`
     */
    function is_not_false(mixed $value) : bool {
        return !is_false($value);
    }
}

if (!exists('is_falsy')) {
    /**
     * Will return true if `$value` is any of the following (trim applied):
     * - false literal
     * - `<string>` false
     * - `<string>` f
     * - `<string>` no
     * - `<string>` n
     * - `<string>` off
     * - `<int>` 0
     * - `<string>` 0
     */
    function is_falsy(mixed $value) : bool
    {
        if (is_null($value)) return false;

        if (is_bool($value)) $value = var_export($value, true);

        return preg_match("/^(0|f(alse)?|n(o)?|off)$/i", trim(strval($value))) === 1;
    }
}

if (!exists('is_true')) {
    /**
     * @return true if the value is `true` literal
     */
    function is_true(mixed $value) : bool {
        return $value === true;
    }
}

if (!exists('is_not_true')) {
    /**
     * @return true if the value is anything but literal `true`
     */
    function is_not_true(mixed $value) : bool {
        return !is_true($value);
    }
}

if (!exists('is_truthy')) {
    /**
     * Will return true if `$value` is any of the following:
     * - true literal
     * - `<string>` true
     * - `<string>` t
     * - `<string>` yes
     * - `<string>` y
     * - `<string>` on
     * - `<int>` 1
     * - `<string>` 1
     */
    function is_truthy(mixed $value) : bool
    {
        if (is_null($value)) return false;

        if (is_bool($value)) $value = var_export($value, true);

        return preg_match("/^(1|t(rue)?|y(es)?|on)$/i", trim(strval($value))) === 1;
    }
}

if (!exists('is_non_null')) {
    /**
     * @return true if `$value` is not null
     */
    function is_non_null(mixed $value) : bool {
        return !is_null($value);
    }
}

if (!exists('is_empty')) {
    /**
     * `is_empty` will return true for the following conditions:
     * - `$value` is null
     * - if `<string>` then string length == 0 (trim applied)
     * - if `<array>` then `empty($value)`
     * - if `<object>` then `empty(get_object_vars($value))`
     * - if `<numeric>` then `$value == 0`
     * - otherwise false
     */
    function is_empty(mixed $value) : bool {
        if (is_null($value)) return true;

        if (is_array($value)) return empty($value);
        else if (is_string($value)) {
            $value = i18nString::normalize($value ?? "", remove_whitespace: true);

            if (strlen($value) > 0) {
                if (i18nNumber::is_numeric($value)) {
                    i18nNumber::resolve($value);
                    return $value == 0;
                }
                return false;
            }

            return strlen($value) === 0;
        }
        else if (is_scalar($value))
            return $value == 0;
        else if (is_object($value))
            return empty(get_object_vars($value));

        return false;
    }
}

if (!exists('contains')) {
    /**
     * `contains` will return true for the following conditions:
     * - `$haystack <array>` then `in_array($needle, $haystack)`
     * - `$haystack <object>` then `in_array($needle, array_keys(get_object_vars($haystack)))`
     * - `$needle <string> && $haystack <string>` then `str_contains($haystack, $needle)`
     * - `$needle <numeric> && $haystack <numeric>` then `str_contains(strval($haystack), strval($needle)))`
     * - otherwise false
     *
     * Lookups are done in a case-sensitive manner where appropriate
     */
    function contains(mixed $needle, mixed $haystack) : bool {
        if (is_array($haystack)) return in_array($needle, $haystack, true);
        else if (is_null($needle)) return false;
        else if (is_object($haystack)) return in_array($needle, array_keys(get_object_vars($haystack)), true);
        else if (is_string($needle) && is_string($haystack) && !i18nNumber::is_numeric($needle) && !i18nNumber::is_numeric($haystack))
            return str_contains($haystack, $needle);
        else if (is_scalar($needle) && is_scalar($haystack))
            return str_contains(strval($haystack),strval($needle));
        return false;
    }
}

if (!exists('icontains')) {
    /**
     * Like `contains()` but case insensitive lookups where appropriate and loose equality checks
     */
    function icontains(mixed $needle, mixed $haystack) : bool {
        if (is_string($needle)) $needle = i18nString::tolower($needle);
        if (is_string($haystack)) $haystack = i18nString::tolower($haystack);

        if (is_array($haystack)) {
            $arr = array_map(function ($i) {
                if (is_string($i)) return i18nString::tolower($i);
                return $i;
            }, $haystack);

            return in_array($needle, $arr);
        }
        else if (is_null($needle)) return false;
        else if (is_object($haystack))
            return in_array($needle, array_map('\\FT\\Predicates\\Locale\\i18nString::tolower', array_keys(get_object_vars($haystack))));
        else if (is_string($needle) && is_string($haystack) && !i18nNumber::is_numeric($needle) && !i18nNumber::is_numeric($haystack))
            return str_contains($haystack, $needle);
        else if (is_scalar($needle) && is_scalar($haystack))
            return str_contains(strval($haystack), strval($needle));
        return false;
    }
}

if (!exists('is_palidrome')) {
    function is_palidrome(string | int | null $value) : bool
    {
        if (is_null($value)) return false;

        if (is_int($value))
            $value = strval($value);

        $value = trim($value);

        return strlen($value) > 0 && strrev($value) === $value;
    }
}

if (!exists('ends_with')) {
    /**
     * This method will return true under the following conditions:
     * - `$haystack <array>` then last element in array == `$needle`
     * - `$haystack <string | numeric>` then `str_ends_with($haystack, $needle)`
     * - `false` otherwise
     */
    function ends_with(mixed $needle, mixed $haystack) : bool {
        $copy = $haystack;
        if (is_null($needle) || is_null($copy)) return false;
        if (i18nNumber::is_numeric($needle)) {
            i18nNumber::resolve($needle);
            $needle = strval($needle);
        }
        if (i18nNumber::is_numeric($copy)) {
            i18nNumber::resolve($copy);
            $copy = strval($copy);
        }

        if (is_array($copy) && !empty($copy))
            return end($copy) == $needle;
        else if (is_string($copy))
            return str_ends_with($copy, $needle);

        return false;
    }
}

if (!exists('iends_with')) {
    /**
     * Like `ends_with()` but case insensitive look ups
     */
    function iends_with(mixed $needle, mixed $haystack) : bool {
        $copy = $haystack;
        if (is_null($needle) || is_null($copy)) return false;

        if (i18nNumber::is_numeric($needle)) {
            i18nNumber::resolve($needle);
            $needle = strval($needle);
        }
        if (i18nNumber::is_numeric($copy)) {
            i18nNumber::resolve($copy);
            $copy = strval($copy);
        }

        if (is_string($needle)) $needle = i18nString::tolower($needle);
        if (is_string($copy)) $copy = i18nString::tolower($copy);

        if (is_array($copy) && !empty($copy)) {
            $end = end($copy);
            if (is_string($end)) $end = i18nString::tolower($end);
            return $end == $needle;
        }
        else if (is_string($copy))
            return str_ends_with($copy, $needle);

        return false;
    }
}

if (!exists('starts_with')) {
    /**
     * This method will return true under the following conditions:
     * - `$haystack <array>` then first element in array == `$needle`
     * - `$haystack <string | numeric>` then `str_starts_with($haystack, $needle)`
     * - false otherwise
     */
    function starts_with(mixed $needle, mixed $haystack) : bool {
        $copy = $haystack;
        if (is_null($needle) || is_null($copy)) return false;
        if (i18nNumber::is_numeric($needle)) {
            i18nNumber::resolve($needle);
            $needle = strval($needle);
        }
        if (i18nNumber::is_numeric($copy)) {
            i18nNumber::resolve($copy);
            $copy = strval($copy);
        }

        if (is_array($copy) && !empty($copy))
            return reset($copy) == $needle;
        else if (is_string($copy))
            return str_starts_with($copy, $needle);

        return false;
    }
}

if (!exists('istarts_with')) {
    /**
     * Like `starts_with()` but case insensitive look ups
     */
    function istarts_with(mixed $needle, mixed $haystack) : bool
    {
        $copy = $haystack;
        if (is_null($needle) || is_null($copy)) return false;

        if (i18nNumber::is_numeric($needle)) {
            i18nNumber::resolve($needle);
            $needle = strval($needle);
        }
        if (i18nNumber::is_numeric($copy)) {
            i18nNumber::resolve($needle);
            $copy = strval($copy);
        }

        if (is_string($needle)) $needle = i18nString::tolower($needle);
        if (is_string($copy)) $copy = i18nString::tolower($copy);

        if (is_array($copy) && !empty($copy)) {
            $start = reset($copy);
            if (is_string($start)) $start = i18nString::tolower($start);
            return $start == $needle;
        } else if (is_string($copy))
            return str_starts_with($copy, $needle);

        return false;
    }
}