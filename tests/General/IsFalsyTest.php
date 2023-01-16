<?php
use FT\Predicates\Test\SimplePredicateTest;

class IsFalsyTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_falsy';

    public function false_args(): array {
        return [
            [''],
            [null],
            ['y'],
            [1],
            [true],
            ['on'],
            ['YES'],
            ['T']
        ];
    }

    public function true_args() : array {
        return[
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

}