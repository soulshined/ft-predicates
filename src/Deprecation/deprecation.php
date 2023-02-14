<?php

namespace FT\Predicates\Deprecation;

$GLOBALS['ft_pred_deprecations'] = parse_ini_file(__DIR__ .'/./deprecations.ini', true);
$GLOBALS['ft_pred_next_minor_v'] = join(".", [PHP_MAJOR_VERSION, PHP_MINOR_VERSION + 1, 0]);

function validate(string $name) {
    global $ft_pred_deprecations, $ft_pred_next_minor_v;

    if ($ft_pred_deprecations[$name] ?? false) {

        $fn = $ft_pred_deprecations[$name];

        $in_version_range = version_compare(PHP_VERSION, $fn['version']) > -1 &&
                            version_compare($fn['version'], $ft_pred_next_minor_v) === -1;

        if ($in_version_range)
            trigger_error($fn['message'] ?? "function '$name' is a native PHP function now and collides with FT\Predicates function by the same name. The FT\Predicate function will no longer be used in the future please plan accordingly", E_USER_DEPRECATED);
    }
};