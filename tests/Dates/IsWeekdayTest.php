<?php

use FT\Predicates\Test\SimplePredicateTest;

class IsWeekdayTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_weekday';

    public function false_args(): array {
        return [
            [''],
            [new DateTime('saturday')],
            [7],
            ['07'],
            ['saturday'],
            ['sat'],
            ['SUNDAY'],
            ['sun'],
        ];
    }

    public function true_args() : array {
        return[
            ['monday'],
            ['TUESday'],
            ['WEDNESDAY'],
            ['thursday'],
            ['friday'],
            ['mon'],
            ['tue'],
            ['wed'],
            ['thu'],
            ['fri'],
            [new DateTime('monday')],
            [new DateTime('mon')],
            ['2'],
            ['3'],
            ['4'],
            ['5'],
            ['6'],
            [2],
            [3],
            [4],
            [5],
            [6],
        ];
    }

}