<?php

use FT\Predicates\Test\SimplePredicateTest;

class IsWeekenddayTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_weekend_day';

    public function false_args(): array {
        return [
            [''],
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

    public function true_args() : array {
        return[
            [new DateTime('saturday')],
            ['sat'],
            ['saturDAY'],
            ['sun'],
            ['SUNday'],
            [new DateTime('saturday')],
            [new DateTime('sun')],
            ['1'],
            ['07'],
            [1],
            [7],
        ];
    }

}