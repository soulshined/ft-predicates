<?php

use FT\Predicates\Test\Dates\BaseDateTest;

class IsDayOfWeekTest extends BaseDateTest {

    protected const PREDICATE = 'is_dayofweek';

    public function false_args(): array {
        return [
            [''],
            [null],
            [0],
            ['08'],
            ['january'],
            ['oct'],
        ];
    }

    public function true_args() : array {
        return[
            [7],
            ['06'],
            ['tue'],
            ['monday'],
            ['SATURDAY'],
        ];
    }

}