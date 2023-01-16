<?php
use FT\Predicates\Test\SimplePredicateTest;

class ZeroTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_zero';

    public function false_args(): array {
        return [
            [''],
            [null],
            [-1],
            ['one'],
            [2.2],
            [0.1]
        ];
    }

    public function true_args() : array {
        return[
            ['0'],
            [0],
            [000000000]
        ];
    }

}