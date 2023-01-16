<?php
use FT\Predicates\Test\SimplePredicateTest;

class HarshadTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_harshad';

    public function false_args(): array {
        return [
            [''],
            [null],
            [11],
            ['11'],
            [0],
            [-1],
            [1.1]
        ];
    }

    public function true_args() : array {
        return[
            [1],
            [2],
            [3],
            [4],
            [5],
            [6],
            [7],
            [8],
            [9],
            [10],
            [12],
            [18],
            [20],
            [80118],
            [99972],
        ];
    }

}