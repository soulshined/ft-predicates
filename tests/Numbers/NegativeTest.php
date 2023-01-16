<?php

use FT\Predicates\Test\SimplePredicateTest;

class NegativeTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_negative';

    public function false_args(): array {
        return [
            [''],
            [null],
            [0.0],
            [0],
            ['0'],
            [12345]
        ];
    }

    public function true_args() : array {
        return[
            ['-1'],
            ['-.1'],
            [-1],
            [-.1],
            [-PHP_INT_MAX]
        ];
    }

}