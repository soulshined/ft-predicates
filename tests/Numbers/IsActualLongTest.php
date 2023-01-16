<?php

use FT\Predicates\Test\SimplePredicateTest;

class IsActualLongTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_actual_long';

    public function false_args(): array {
        return [
            [''],
            [C_LONG_MIN], //floating point type juggling inaccuracy
            [null],
            [10000.00],
            ['10000000.00'],
            ['10000000000000000000000000000000000'],
            ['-10000000000000000000000000000000000'],
            [10000000000000000000000000000000000],
            [1.0E0],
            ['1.0E0'],
            [strval(PHP_INT_MAX + 1)],
            [strval(-(PHP_INT_MAX + 1))],
            [-0.1],
        ];
    }

    public function true_args() : array {
        return[
            [PHP_INT_MAX + 100], //floating point type juggling inaccuracy
            [PHP_INT_MAX],
            [C_LONG_MAX],
            [PHP_INT_MIN],
        ];
    }

}