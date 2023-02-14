<?php

$locale = $argv[1];

putenv("ft.ini=" . __DIR__ . '/../../ft.ini');
putenv("lang=$locale");
putenv('ft.log_level=Debug');

$output = [];
exec("php ./vendor/bin/phpunit tests --verbose --colors --filter $locale\_Test", $output);

print_r("\n" . join("\n", $output) . "\n");