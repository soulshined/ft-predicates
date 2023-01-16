<?php
use FT\Predicates\Test\SimplePredicateTest;

class IsTruthyTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_truthy';

    public function false_args(): array {
        return [
            [''],
            [null],

            [false],
            ['FALSE'],
            ['F'],
            ['NO'],
            ['N'],
            [0],
            ["0"],
            ["oFF"],
            ['   false'],
        ];
    }

    public function true_args() : array {
        return[
            [true],
            ["true"],
            ['T'],
            ['YES'],
            ['y'],
            [1],
            ["1"],
            ['on'],
            ['   true']
        ];
    }

}