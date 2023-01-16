<?php

use FT\Predicates\Locale\i18n;
use FT\Predicates\Locale\i18nString;

use function FT\Predicates\Deprecation\validate;
use function function_exists as exists;

foreach ([
    'is_http_method',
    'is_http_post',
    'is_http_get',
    'is_http_put',
    'is_http_options',
    'is_http_head',
    'is_http_delete',
    'is_http_connect',
    'is_http_trace',
    'is_http_patch',
] as $fn) { validate($fn); }

if (!exists('is_http_method')) {
    /**
     * @return true if the value is a valid HTTP request method
     */
    function is_http_method(?string $value) : bool {
        $value = i18nString::tolower($value ?? "");

        foreach([
            'post',
            'get',
            'put',
            'options',
            'head',
            'delete',
            'connect',
            'trace',
            'patch'
        ] as $method) {
            if (i18n::$collator->compare($value, $method) === 0)
                return true;
        }

        return false;
    }
}

if (!exists('is_http_post')) {
    /**
     * @return true if `$value` is an HTTP POST request. If a string is not provided or is null, the request method in the global `$_SERVER` variable will be used by default
     */
    function is_http_post(?string $value = null) : bool {
        $value = is_null($value) ? $_SERVER['REQUEST_METHOD'] ?? "" : $value;
        return i18n::$collator->compare(i18nString::tolower($value), 'post') === 0;
    }
}

if (!exists('is_http_get')) {
    /**
     * @return true if `$value` is an HTTP GET request. If a string is not provided or is null, the request method in the global `$_SERVER` variable will be used by default
     */
    function is_http_get(?string $value = null) : bool {
        $value = is_null($value) ? $_SERVER['REQUEST_METHOD'] ?? "" : $value;
        return i18n::$collator->compare(i18nString::tolower($value), 'get') === 0;
    }
}

if (!exists('is_http_put')) {
    /**
     * @return true if `$value` is an HTTP PUT request. If a string is not provided or is null, the request method in the global `$_SERVER` variable will be used by default
     */
    function is_http_put(?string $value = null) : bool {
        $value = is_null($value) ? $_SERVER['REQUEST_METHOD'] ?? "" : $value;
        return i18n::$collator->compare(i18nString::tolower($value), 'put') === 0;
    }
}

if (!exists('is_http_options')) {
    /**
     * @return true if `$value` is an HTTP OPTIONS request. If a string is not provided or is null, the request method in the global `$_SERVER` variable will be used by default
     */
    function is_http_options(?string $value = null) : bool {
        $value = is_null($value) ? $_SERVER['REQUEST_METHOD'] ?? "" : $value;
        return i18n::$collator->compare(i18nString::tolower($value), 'options') === 0;
    }
}

if (!exists('is_http_head')) {
    /**
     * @return true if `$value` is an HTTP HEAD request. If a string is not provided or is null, the request method in the global `$_SERVER` variable will be used by default
     */
    function is_http_head(?string $value = null) : bool {
        $value = is_null($value) ? $_SERVER['REQUEST_METHOD'] ?? "" : $value;
        return i18n::$collator->compare(i18nString::tolower($value), 'head') === 0;
    }
}

if (!exists('is_http_delete')) {
    /**
     * @return true if `$value` is an HTTP DELETE request. If a string is not provided or is null, the request method in the global `$_SERVER` variable will be used by default
     */
    function is_http_delete(?string $value = null) : bool {
        $value = is_null($value) ? $_SERVER['REQUEST_METHOD'] ?? "" : $value;
        return i18n::$collator->compare(i18nString::tolower($value), 'delete') === 0;
    }
}

if (!exists('is_http_connect')) {
    /**
     * @return true if `$value` is an HTTP CONNECT request. If a string is not provided or is null, the request method in the global `$_SERVER` variable will be used by default
     */
    function is_http_connect(?string $value = null) : bool {
        $value = is_null($value) ? $_SERVER['REQUEST_METHOD'] ?? "" : $value;
        return i18n::$collator->compare(i18nString::tolower($value), 'connect') === 0;
    }
}

if (!exists('is_http_trace')) {
    /**
     * @return true if `$value` is an HTTP TRACE request. If a string is not provided or is null, the request method in the global `$_SERVER` variable will be used by default
     */
    function is_http_trace(?string $value = null) : bool {
        $value = is_null($value) ? $_SERVER['REQUEST_METHOD'] ?? "" : $value;
        return i18n::$collator->compare(i18nString::tolower($value), 'trace') === 0;
    }
}

if (!exists('is_http_patch')) {
    /**
     * @return true if `$value` is an HTTP PATCH request. If a string is not provided or is null, the request method in the global `$_SERVER` variable will be used by default
     */
    function is_http_patch(?string $value = null) : bool {
        $value = is_null($value) ? $_SERVER['REQUEST_METHOD'] ?? "" : $value;
        return i18n::$collator->compare(i18nString::tolower($value), 'patch') === 0;
    }
}