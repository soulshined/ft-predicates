<?php

use FT\Predicates\Test\Dates\BaseDateTest;

class IsNextMonthTest extends BaseDateTest {

    protected const PREDICATE = 'is_next_month';

    public function false_args(): array
    {

        $same_month_as_next_month_different_year =
            new DateTime("01 " . $this->getNextMonthName() . " " . $this->getYearInt() + 2);

        return [
            [''],
            [null],
            [$this->getMonthName()],
            [$this->getMonthNameAbbr()],
            [$this->getMonthDigit()],
            [$this->getLastMonthName()],
            [$this->getLastMonthNameAbbr()],
            [$this->getLastMonthDigit()],

            [$same_month_as_next_month_different_year],
        ];
    }

    public function true_args(): array
    {
        return [
            [$this->getNextMonthDigit()],
            [$this->getNextMonthInt()],
            [$this->getNextMonthName()],
            [$this->getNextMonthNameAbbr()],
            [new DateTime('first day of next month')]
        ];
    }
}