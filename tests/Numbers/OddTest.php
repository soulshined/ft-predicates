<?php
use FT\Predicates\Test\SimplePredicateTest;

class OddTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_odd';

    public function false_args(): array {
        return [
            [''],
            [null],
            [2],
            ['2'],
            [2.],
            [4],
            ['two'],
            ['-2'],
            ['-2.'],
            [pow(10, 100)],
            [-pow(10, 100)]
        ];
    }

    public function true_args() : array {
        return[
            ['1'],
            [3],
            [5.],
            [-7],
            ['-9'],
            [-11.],
            [pow(9, 10)],
            [-pow(9, 10)]
        ];
    }

}