<?php
use FT\Predicates\Test\SimplePredicateTest;

class IsHappyNumberTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_happy_number';

    public function false_args(): array {
        return [
            [''],
            [null],
            [0],
            ['0'],
            [1.5],
            [3],
            [-1]
        ];
    }

    public function true_args() : array {
        return[
            [1],
            [7],
            [10],
            [23],
            [31],
            [32],
            [100],
            [999998]
        ];
    }

}