<?php

use FT\Predicates\Test\Dates\BaseDateTest;

class IsThisYearTest extends BaseDateTest {

    protected const PREDICATE = 'is_this_year';

    public function false_args(): array {
        return [
            [''],
            [null],
            [-100],
            [$this->getYearInt() - 1],
            [$this->getYearInt() + 1],
        ];
    }

    public function true_args() : array {
        return[
            [2023],
            ['2023-01-01'],
            [new DateTime('2023-01-01')],
        ];
    }

}