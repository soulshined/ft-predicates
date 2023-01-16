<?php

use function FT\Predicates\Deprecation\validate;
use function function_exists as exists;

foreach ([
    'is_version_number',
    'is_past_version',
    'is_future_version',
    'is_current_version',
    'is_php8',
    'is_php7',
    'is_php6'
] as $fn) { validate($fn); }

if (!exists('is_version_number')) {
    /**
     * Versions must match one of the following patterns:
     * - `#`
     * - `#.#`
     * - `#.#.#`
     */
    function is_version_number(?string $value) : bool {
        if (is_null($value)) return false;

        return preg_match("/^((\d+\.)?\d+\.\d+|(\d+\.)?\d+)$/", $value) === 1;
    }
}

if (!exists('is_past_version')) {
    /**
     * @return true if `$value` is less than the `PHP_VERSION` constant value
     */
    function is_past_version(?string $value) : bool {
        if (!is_version_number($value)) return false;

        return version_compare($value, PHP_VERSION, 'lt');
    }
}

if (!exists('is_future_version')) {
    /**
     * @return true if `$value` is greater than the `PHP_VERSION` constant value
     */
    function is_future_version(?string $value) : bool
    {
        if (!is_version_number($value)) return false;

        return version_compare($value, PHP_VERSION, 'gt');
    }
}

if (!exists('is_current_version')) {
    /**
     * @return true `$value` falls between the beginning of the current minor version and the next minor version
     */
    function is_current_version(?string $value) : bool
    {
        if (!is_version_number($value)) return false;

        return version_compare($value, join(".", [PHP_MAJOR_VERSION, PHP_MINOR_VERSION, 0]), 'ge') &&
               version_compare($value, join(".", [PHP_MAJOR_VERSION, PHP_MINOR_VERSION + 1, 0]), 'lt');
    }
}

if (!exists('is_php8')) {
    /**
     * @return true `$value` is greater than or equal to 8 and less than 9
     * If `$value` is null `PHP_MAJOR_VERSION` will be used implicitly
     */
    function is_php8(?string $value = null) : bool {
        if (is_null($value))
            return PHP_MAJOR_VERSION == 8;

        return is_version_number($value) &&
               version_compare($value, '8', 'ge') &&
               version_compare($value, '9', 'lt');
    }
}

if (!exists('is_php7')) {
    /**
     * @return true `$value` is greater than or equal to 7 and less than 8
     * If `$value` is null `PHP_MAJOR_VERSION` will be used implicitly
     */
    function is_php7(?string $value = null) : bool {
        if (is_null($value))
            return PHP_MAJOR_VERSION == 7;

        return is_version_number($value) &&
               version_compare($value, '7', 'ge') &&
               version_compare($value, '8', 'lt');
    }
}

if (!exists('is_php6')) {
    /**
     * @return true `$value` is greater than or equal to 6 and less than 7
     * If `$value` is null `PHP_MAJOR_VERSION` will be used implicitly
     */
    function is_php6(?string $value = null) : bool {
        if (is_null($value))
            return PHP_MAJOR_VERSION == 6;

        return is_version_number($value) &&
               version_compare($value, '6', 'ge') &&
               version_compare($value, '7', 'lt');
    }
}