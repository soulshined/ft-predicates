<?php
use FT\Predicates\Test\SimplePredicateTest;

class IsWholeTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_whole';

    public function false_args(): array {
        return [
            [''],
            [null],
            [0.1],
            [-1],
            [10000.00]
        ];
    }

    public function true_args() : array {
        return[
            ['0'],
            [0],
            [0.0],
            [1],
            ['1'],
            [C_LONG_MAX],
            [C_LONG_MAX * 2]
        ];
    }

}