<?php

use FT\Predicates\Test\SimplePredicateTest;

class IsActualIntTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_actual_int';

    public function false_args(): array {
        return [
            [''],
            [null],
            ['10000000000000000000000000000000000'],
            [10000000000000000000000000000000000],
            [10000.01],
            ['2147483648.00'],
            [1.0E0],
            ['1.0E0'],
            [PHP_INT_MAX],
            [C_INT_MAX + 1],
            [-C_INT_MIN + 1],
        ];
    }

    public function true_args() : array {
        return[
            [1],
            [-1],
            [C_INT_MAX],
            [-C_INT_MAX],
            [C_INT_MIN],
            [strval(C_INT_MAX)],
            [strval(-C_INT_MAX)]
        ];
    }

}