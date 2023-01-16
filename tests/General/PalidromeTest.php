<?php
use FT\Predicates\Test\SimplePredicateTest;

class PalidromeTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_palidrome';

    public function false_args(): array {
        return [
            [''],
            [null],
            [1234567890],
            ['aoeuhtns'],
            ['      ']
        ];
    }

    public function true_args() : array {
        return[
            [123454321],
            ['abba'],
            ['racecar']
        ];
    }

}