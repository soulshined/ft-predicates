<?php
use FT\Predicates\Test\SimplePredicateTest;

class IsNaturalTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_natural';

    public function false_args(): array {
        return [
            [''],
            [null],
            ['0'],
            [0],
            [0.1],
            [-1],
            [10000.00]
        ];
    }

    public function true_args() : array {
        return[
            [1],
            ['1'],
            [C_LONG_MAX],
            [C_LONG_MAX * 2]
        ];
    }

}