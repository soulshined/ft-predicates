<?php

use FT\Predicates\Test\Dates\BaseDateTest;

class IsLastYearTest extends BaseDateTest {

    protected const PREDICATE = 'is_last_year';

    public function false_args(): array
    {
        return [
            [''],
            [null],
            [-100],
            [2024],
            ['2024-01-01'],

            [$this->getYearInt() + 1],
            [$this->getYearInt()],
        ];
    }

    public function true_args(): array
    {
        return [
            [2022],
            ['2022-01-01'],
            [new DateTime('2022-01-01')],
        ];
    }
}