<?php

use function FT\Predicates\Deprecation\validate;
use function function_exists as exists;

foreach ([
    'is_windows',
    'is_linux',
    'is_darwin',
    'is_bsd',
    'is_solaris',
] as $fn) { validate($fn); }

if (!exists('is_windows')) {
    /**
     * @return true if the PHP_OS_FAMILY constant value is Windows
     */
    function is_windows() : bool {
        return PHP_OS_FAMILY === 'Windows';
    }
}

if (!exists('is_linux')) {
    /**
     * @return true if the PHP_OS_FAMILY constant value is Linux
     */
    function is_linux() : bool {
        return PHP_OS_FAMILY === 'Linux';
    }
}

if (!exists('is_darwin')) {
    /**
     * @return true if the PHP_OS_FAMILY constant value is Darwin
     */
    function is_darwin() : bool {
        return PHP_OS_FAMILY === 'Darwin';
    }
}

if (!exists('is_bsd')) {
    /**
     * @return true if the PHP_OS_FAMILY constant value is BSD
     */
    function is_bsd() : bool {
        return PHP_OS_FAMILY === 'BSD';
    }
}

if (!exists('is_solaris')) {
    /**
     * @return true if the PHP_OS_FAMILY constant value is Solaris
     */
    function is_solaris() : bool {
        return PHP_OS_FAMILY === 'Solaris';
    }
}
