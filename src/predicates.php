<?php

use FT\Predicates\Locale\i18n;

use function FT\Predicates\Deprecation\validate;
use function function_exists as exists;

i18n::load();

foreach ([
    'general',
    'strings',
    'numbers',
    'server',
    'platform',
    'php',
    'dates'
] as $pred) {
    require __DIR__ . "/./$pred.php";
}

foreach ([
    'is_and',
    'is_nn_and',
    'is_nand',
    'is_not',
    'is_xor',
    'is_xnor',
    'is_or',
    'is_nor',
] as $fn) { validate($fn); }

if (!exists('is_and')) {
    /**
     * @return callable that returns true if and only if all predicates return true
     */
    function is_and(string | callable ...$predicate) : callable {
        return function ($i) use ($predicate) {
            foreach ($predicate as $fn)
                if (call_user_func($fn, $i) === false) return false;

            return true;
        };
    }
}

if (!exists('is_nn_and')) {
    /**
     * `is_non_null_and`
     * @return callable that returns true if and only if all predicates return true, omitting nulls
     */
    function is_nn_and(string | callable ...$predicate) : callable {
        return function ($i) use ($predicate) {
            foreach ($predicate as $fn)
                if (is_null($i) || call_user_func($fn, $i) === false) return false;

            return true;
        };
    }
}

if (!exists('is_nand')) {
    /**
     * @return callable that returns true if any of the predicates return false
     */
    function is_nand(string | callable ...$predicate) : callable
    {
        return function ($i) use ($predicate) {
            foreach ($predicate as $fn)
                if (call_user_func($fn, $i) === false) return true;

            return false;
        };
    }
}

if (!exists('is_not')) {
    /**
     * @return callable that returns true if `$callable` returns false
     */
    function is_not(string | callable $callable) : callable {
        return function ($i) use ($callable) {
            return call_user_func($callable, $i) === false;
        };
    }
}

if (!exists('is_xor')) {
    /**
     * @return callable that returns true if one of the predicates returns true, but not both
     */
    function is_xor(string | callable $apred, string | callable $bpred) : callable {
        return function ($i) use ($apred, $bpred) {
            return (call_user_func($apred, $i) ^ call_user_func($bpred, $i)) === 1;
        };
    }
}

if (!exists('is_xnor')) {
    /**
     * negated `is_xor()`
     * @return callable that returns true if and only if both of the predicates return the same value
     */
    function is_xnor(string | callable $apred, string | callable $bpred) : callable {
        return function ($i) use ($apred, $bpred) {
            return (call_user_func($apred, $i) ^ call_user_func($bpred, $i)) === 0;
        };
    }
}

if (!exists('is_or')) {
    /**
     * @return callable that returns true if any of the predicates return true
     */
    function is_or(string | callable  ...$predicate) : callable {
        return function ($i) use ($predicate) {
            foreach ($predicate as $fn) {
                $result = call_user_func($fn, $i);
                if ($result === false) continue;
                else if ($result === true) return true;
            }
            return false;
        };
    }
}

if (!exists('is_nor')) {
    /**
     * @return callable that returns true if all the predicates return false
     */
    function is_nor(string | callable  ...$predicate) : callable {
        return function ($i) use ($predicate) {
            return !is_or(...$predicate)($i);
        };
    }
}

unset($GLOBALS['ft_pred_next_minor_v']);
unset($GLOBALS['ft_pred_deprecations']);