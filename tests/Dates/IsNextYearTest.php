<?php

use FT\Predicates\Test\Dates\BaseDateTest;

class IsNextYearTest extends BaseDateTest {

    protected const PREDICATE = 'is_next_year';

    public function false_args(): array
    {
        return [
            [''],
            [null],
            [-100],
            [2025],
            ['12350987aeustnh'],
            [$this->getYearInt()],
            [$this->getYearInt() - 1],
        ];
    }

    public function true_args(): array
    {
        return [
            [2024],
            ['2024-01-01'],
            [new DateTime('2024-01-01')],
        ];
    }

}