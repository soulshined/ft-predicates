<?php

use FT\Predicates\Test\SimplePredicateTest;

class NonZeroTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_non_zero';

    public function false_args(): array {
        return [
            [''],
            [null],
            [0],
            ['0'],
            ['0.000000'],
            ['zero']
        ];
    }

    public function true_args() : array {
        return[
            ['1'],
            ['-1'],
            ['1'],
            [1],
            [1.1]
        ];
    }

}