<?php
use FT\Predicates\Test\SimplePredicateTest;

class IsLeapYearTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_leap_year';

    public function false_args(): array {
        return [
            [''],
            [null],
            [2001],
            ['2001'],
            ['2027-01-01']
        ];
    }

    public function true_args() : array {
        return[
            ['2024-01-01'],
            [new DateTime('2096')],
            [new DateTime('2084')]
        ];
    }

}