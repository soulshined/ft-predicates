<?php

use FT\Predicates\Test\Dates\BaseDateTest;

class IsMonthTest extends BaseDateTest {

    protected const PREDICATE = 'is_month';

    public function false_args(): array {
        return [
            [''],
            [null],
            [0],
            [99],
            [13],
            ['010'],
            ['ferbaruary'],
            ['   FEBRUARY'],
        ];
    }

    public function true_args() : array {
        return[
            ['jan'],
            ['january'],
            ['FeB'],
            ['february'],
            ['mar'],
            ['march'],
            ['apr'],
            ['april'],
            ['may'],
            ['jun'],
            ['june'],
            ['jul'],
            ['july'],
            ['aug'],
            ['august'],
            ['nov'],
            ['november'],
            ['dec'],
            ['december'],
            [1],
            [2],
            [3],
            [4],
            [5],
            [6],
            [7],
            [8],
            [8],
            [9],
            [10],
            [11],
            [12],
            ['1'],
            ['01'],
            ['2'],
            ['02'],
            ['3'],
            ['03'],
            ['4'],
            ['04'],
            ['5'],
            ['05'],
            ['6'],
            ['06'],
            ['7'],
            ['07'],
            ['8'],
            ['08'],
            ['8'],
            ['08'],
            ['9'],
            ['09'],
            ['10'],
            ['11'],
            ['12'],
        ];
    }

}