<?php

use function FT\Predicates\Deprecation\validate;
use function function_exists as exists;
use FT\Predicates\Locale\i18n;
use FT\Predicates\Locale\i18nString;

foreach ([
    'is_e_notation',
    'is_lower',
    'is_lower_strict',
    'is_upper',
    'is_upper_strict',
    'is_digit',
    'has_digit',
    'is_alpha',
    'has_alpha',
    'is_whitespace',
    'has_whitespace',
    'is_punctuation',
    'has_punctuation',
    'has_text',
    'is_rtrimmed',
    'is_ltrimmed',
    'is_trimmed',
    'is_email',
    'is_regex',
    'is_ip',
    'is_ipv4',
    'is_ipv6',
    'is_url',
    'is_date',
    'is_us_state_abbr',
    'is_us_state_name',
    'is_us_state',
    'is_us_territory',
    'is_us_phone'
] as $fn) { validate($fn); }

if (!exists('is_e_notation')) {
    /**
     * @return true if `$value` is an e-notated number
     */
    function is_e_notation(?string $value) : bool
    {
        //https://github.com/php/php-src/blob/db6306dd0ea6b08586a245a559e428fd1e18e8c1/Zend/zend_operators.c
        if (is_null($value)) return false;

        $dec = preg_quote(i18n::$localeconv->DECIMAL_SYMBOL);
        $plusminus = preg_quote(i18n::$localeconv->PLUS_SYMBOL . i18n::$localeconv->MINUS_SYMBOL);

        $ws = "\s*";
        $lnum = "[0-9]+";
        $dnum = "(([0-9]*)?$dec$lnum|$lnum$dec" . "[0-9]*)";

        $pattern = join([
            "/^$ws",
            "[$plusminus]?",
            "(($lnum|$dnum)[eE][$plusminus]?$lnum)",
            "$ws$/"
        ]);

        return preg_match($pattern, $value) === 1;
    }
}

if (!exists('is_lower')) {
    /**
     * @return true if all of the alpha characters in a string are lowercase, omitting whitespace and punctuation from validation as defined by `IntlChar::isULowercase()`
     */
    function is_lower(?string $value) : bool {
        $value = i18nString::normalize(i18nString::trim($value));
        if (is_null($value) || strlen($value) === 0) return false;

        $has_alpha = false;

        foreach (mb_str_split($value) as $chr) {
            if (IntlChar::isUAlphabetic($chr)) {
                $has_alpha = true;
                if (!IntlChar::isULowercase($chr)) return false;
            }
        }

        return $has_alpha;
    }
}

if (!exists('is_lower_strict')) {
    /**
     * @return true if and only if all the characters in the string are lowercase and only alpha chrs as defined by `IntlChar::isULowercase()`
     */
    function is_lower_strict(?string $value) : bool
    {
        $has_alpha = false;

        foreach (mb_str_split($value ?? "") as $chr) {
            if (!IntlChar::isUAlphabetic($chr)) return false;

            $has_alpha = true;
            if (!IntlChar::isULowercase($chr)) return false;
        }

        return $has_alpha;
    }
}

if (!exists('is_upper')) {
    /**
     * @return true if all of the alpha characters in a string are uppercase, omitting whitespace and punc as defined by `IntlChar::isUUppercase()`
     */
    function is_upper(?string $value) : bool
    {
        $value = i18nString::normalize(i18nString::trim($value));
        if (is_null($value) || strlen($value) === 0) return false;

        $has_alpha = false;

        foreach (mb_str_split($value) as $chr) {
            if (IntlChar::isUAlphabetic($chr)) {
                $has_alpha = true;
                if (!IntlChar::isUUppercase($chr)) return false;
            }
        }

        return $has_alpha;
    }
}

if (!exists('is_upper_strict')) {
    /**
     * @return true if and only if all the characters in the string are uppercase and only alpha chrs as defined by `IntlChar::isUUppercase()`'
     */
    function is_upper_strict(?string $value) : bool
    {
        $has_alpha = false;

        foreach (mb_str_split($value ?? "") as $chr) {
            if (!IntlChar::isUAlphabetic($chr)) return false;

            $has_alpha = true;
            if (!IntlChar::isUUppercase($chr)) return false;
        }

        return $has_alpha;
    }
}

if (!exists('is_digit')) {
    /**
     * @return true if all characters in `$value` are digits as defined by `IntlChar::isdigit()`
     */
    function is_digit(?string $value) : bool {
        $has_digit = false;

        foreach (mb_str_split($value ?? "") as $chr) {
            if (!IntlChar::isdigit($chr)) return false;

            $has_digit = true;
        }

        return $has_digit;
    }
}

if (!exists('has_digit')) {
    /**
     * @return true if any character in `$value` is a digit as defined by `IntlChar::isdigit()`
     */
    function has_digit(?string $value) : bool {
        foreach (mb_str_split($value ?? "") as $chr)
            if (IntlChar::isdigit($chr)) return true;

        return false;
    }
}

if (!exists('is_alpha')) {
    /**
     * @return true if all characters in `$value` is alpha as defined by `IntlChar::isUAlphabetic()`
     */
    function is_alpha(?string $value) : bool {
        $has_alpha = false;
        foreach (mb_str_split($value ?? "") as $chr) {
            if (!IntlChar::isUAlphabetic($chr)) return false;

            $has_alpha = true;
        }

        return $has_alpha;
    }
}

if (!exists('has_alpha')) {
    /**
     * @return true if any character in `$value` is alpha as defined by `IntlChar::isUAlphabetic()`
     */
    function has_alpha(mixed $value) : bool {
        foreach (mb_str_split($value ?? "") as $chr)
            if (IntlChar::isUAlphabetic($chr)) return true;

        return false;
    }
}

if (!exists('is_whitespace')) {
    /**
     * @return true if all characters in `$value` are whitespace characters as defined by `IntlChar::isUWhitespace()`
     */
    function is_whitespace(?string $value) : bool {
        $has_whitespace = false;

        foreach (mb_str_split($value ?? "") as $chr) {
            if (!IntlChar::isUWhiteSpace($chr)) return false;

            $has_whitespace = true;
        }

        return $has_whitespace;
    }
}

if (!exists('has_whitespace')) {
    /**
     * @return true if any of the characters in `$value` is a whitespace character as defined by `IntlChar::isUWhitespace()`
     */
    function has_whitespace(?string $value) : bool {
        foreach (mb_str_split($value ?? "") as $chr)
            if (IntlChar::isUWhiteSpace($chr)) return true;

        return false;
    }
}

if (!exists('is_punctuation')) {
    /**
     * @return true if all characters in `$value` are punctuation characters - any printable character that is not `IntlChar::isdigit` and not `IntlChar::isblank` and not `IntlChar::isUAlphabetic` which emulates `ctype_punct()`
     */
    function is_punctuation(?string $value) : bool {
        $has_punc = false;

        foreach (mb_str_split($value ?? "") as $chr) {
            if (!IntlChar::isprint($chr)) return false;

            if (IntlChar::isdigit($chr) or
                IntlChar::isblank($chr) or
                IntlChar::isUAlphabetic($chr)) return false;

            $has_punc = true;
        }

        return $has_punc;
    }
}

if (!exists('has_punctuation')) {
    /**
     * @return true if any character in `$value` is punctuation - any printable character that is not `IntlChar::isdigit` and not `IntlChar::isblank` and not `IntlChar::isUAlphabetic` which emulates `ctype_punct()`
     */
    function has_punctuation(?string $value) : bool {
        foreach (mb_str_split($value ?? "") as $chr)
            if (is_punctuation($chr)) return true;

        return false;
    }
}

if (!exists('has_text')) {
    /**
     * @return true if there are any non-whitespace characters in `$value`
     */
    function has_text(?string $value) : bool
    {
        if (is_empty($value)) return false;

        foreach (mb_str_split($value) as $chr)
            if (IntlChar::isprint($chr) && !IntlChar::isUWhiteSpace($chr)) return true;

        return false;
    }
}

if (!exists('is_rtrimmed')) {
    /**
     * @return true if `$value` is not null and the end of `$value` does not contain whitespace
     */
    function is_rtrimmed(?string $value) : bool {
        if (is_null($value)) return false;

        $value = i18nString::normalize( $value );

        return strlen($value) === strlen(rtrim($value));
    }
}

if (!exists('is_ltrimmed')) {
    /**
     * @return true if `$value` is not null and the start of `$value` does not contain whitespace
     */
    function is_ltrimmed(?string $value) : bool {
        if (is_null($value)) return false;

        $value = i18nString::normalize( $value );

        return strlen($value) === strlen(ltrim($value));
    }
}

if (!exists('is_trimmed')) {
    /**
     * @return true if `$value` is not null and both `r_trimmed()` and `l_trimmed()`
     */
    function is_trimmed(?string $value) : bool {
        return is_ltrimmed($value) && is_rtrimmed($value);
    }
}

if (!exists('is_email')) {
    /**
     * @return true if `$value` is an valid email as defined by `filter_var()`
     */
    function is_email(?string $value) : bool {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }
}

if (!exists('is_regex')) {
    /**
     * @return true if `$value` is a valid regular expression
     */
    function is_regex(?string $value) : bool {
        if (is_null($value)) return false;

        if (!str_ends_with($value, '/') && !str_starts_with($value, '/')) {
            if (strlen($value) === 0) return false;
            $value = "/$value/";
        }

        $result = true;
        try {
            $result = @preg_match($value, "");
        } catch (\Throwable $ignored) { $result = false; }

        return $result !== false && preg_last_error() === PREG_NO_ERROR;
    }
}

if (!exists('is_ip')) {
    /**
     * @return true if `$value` is an ip address as defined by `filter_var()`
     */
    function is_ip(?string $value) : bool {
        return filter_var($value, FILTER_VALIDATE_IP) !== false;
    }
}

if (!exists('is_ipv4')) {
    /**
     * @return true if `$value` is an ipv4 address as defined by `filter_var()`
     */
    function is_ipv4(?string $value) : bool {
        return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    }
}

if (!exists('is_ipv6')) {
    /**
     * @return true if `$value` is an ipv6 address as defined by `filter_var()`
     */
    function is_ipv6(?string $value) : bool {
        return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    }
}

if (!exists('is_url')) {
    /**
     * @return true if `$value` is a valid url as defined by `filter_var()`
     */
    function is_url(?string $value) : bool {
        return filter_var($value, FILTER_VALIDATE_URL) !== false;
    }
}

if (!exists('is_date')) {
    /**
     * @returns true if `$value` can be parsed using `strtotime()`
     */
    function is_date(?string $value) : bool {
        return strtotime($value ?? "") !== false;
    }
}

if (!exists('is_us_state')) {
    function is_us_state(?string $value): bool
    {
        return is_us_state_name($value) || is_us_state_abbr($value);
    }
}

if (!exists('is_us_state_abbr')) {
    function is_us_state_abbr(?string $value) : bool {
        return in_array(strtolower($value ?? ""), [
            'al', 'ak', 'az', 'ar', 'ca', 'co', 'ct', 'de', 'fl', 'ga', 'hi', 'id', 'il','in','ia','ks','ky','la','me','md','ma','mi','mn','ms','mo','mt', 'ne','nv','nh','nj','nm','ny','nc','nd','oh','ok','or','pa','ri','sc','sd','tn','tx','ut','vt','va','wa','wv','wi','wy'
        ]);
    }
}

if (!exists('is_us_state_name')) {
    function is_us_state_name(?string $value) : bool {
        return in_array(strtolower($value ?? ""), [
            "alabama",
            "alaska",
            "arizona",
            "arkansas",
            "california",
            "colorado",
            "connecticut",
            "delaware",
            "florida",
            "georgia",
            "hawaii",
            "idaho",
            "illinois",
            "indiana",
            "iowa",
            "kansas",
            "kentucky",
            "louisiana",
            "maine",
            "maryland",
            "massachusetts",
            "michigan",
            "minnesota",
            "mississippi",
            "missouri",
            "montana",
            "nebraska",
            "nevada",
            "new hampshire",
            "new jersey",
            "new mexico",
            "new york",
            "north carolina",
            "north dakota",
            "ohio",
            "oklahoma",
            "oregon",
            "pennsylvania",
            "rhode island",
            "south carolina",
            "south dakota",
            "tennessee",
            "texas",
            "utah",
            "vermont",
            "virginia",
            "washington",
            "west virginia",
            "wisconsin",
            "wyoming",
        ]);
    }
}

if (!exists('is_us_territory')) {
    function is_us_territory(?string $value) : bool {
        return in_array(strtolower($value ?? ""), [
            'american samoa',
            'guam',
            'northern mariana islands',
            'puerto rico',
            'u.s. virgin islands',
            'us virgin islands',
            'virgin islands'
        ]);
    }
}

if (!exists('is_us_phone')) {
    /**
     * A phone number in this context must match one of the following patterns:
     * - `[2-9]#########` (10 digits starting with any number 2-9)
     * - `[2-9]## ### ####` (10 digits with spaces between parts)
     * - `[2-9]##.###.####` (10 digits with decimals between parts)
     * - `[2-9]##-###-####` (10 digits with hyphens between parts)
     * - `###-####` (7 digits with hyphens between parts)
     * - `###.####` (7 digits with decimals between parts)
     * - `### ####` (7 digits with spaces between parts)
     * - `#######` (7 digits)
     */
    function is_us_phone(?string $value) : bool
    {
        $pattern = join([
            "^(?:",
                "[2-9]\d{2}([ \.\-])\d{3}\\1\d{4}",
                "|\d{7}|[2-9]\d{9}",
                "|\d{3}[ \.\-]\d{4}",
            ")$"
        ]);

        return preg_match("/$pattern/", $value ?? "") === 1;
    }
}