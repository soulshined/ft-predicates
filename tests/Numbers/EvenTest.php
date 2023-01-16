<?php
use FT\Predicates\Test\SimplePredicateTest;

class EvenTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_even';

    public function false_args(): array {
        return [
            [''],
            [null],
            [1],
            ['1'],
            [1.],
            [3],
            ['one'],
            ['-1'],
            ['-1.'],
            [2.2],
            [pow(9, 10)],
            [-pow(9, 10)]
        ];
    }

    public function true_args() : array {
        return[
            ['2'],
            [4],
            [6.],
            [-8],
            ['-10'],
            [-12.],
            [pow(10,100)],
            [-pow(10,100)]
        ];
    }

}