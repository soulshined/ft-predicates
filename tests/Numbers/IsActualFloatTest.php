<?php
use FT\Predicates\Test\SimplePredicateTest;

class IsActualFloatTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_actual_float';

    public function false_args(): array {
        return [
            [''],
            [null],
            ['10000000000000000000000000000000000'],
            ['1.0E0'],
        ];
    }

    public function true_args() : array {
        return[
            ['.1'],
            ['-.0'],
            ['0.1'],
            ['-0.0'],
            [1.0E0],
            [10000000.00],
            ['10000000.00'],
            [10000000000000000000000000000000000]
        ];
    }

}