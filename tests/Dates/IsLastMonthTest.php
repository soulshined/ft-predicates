<?php

use FT\Predicates\Test\Dates\BaseDateTest;

class IsLastMonthTest extends BaseDateTest {

    protected const PREDICATE = 'is_last_month';

    public function false_args(): array
    {
        $same_month_as_last_month_different_year =
            new DateTime("01 " . $this->getLastMonthName() . " " . $this->getYearInt() + 2);

        return [
            [''],
            [null],
            [$this->getMonthName()],
            [$this->getMonthNameAbbr()],
            [$this->getMonthDigit()],
            [$this->getNextMonthName()],
            [$this->getNextMonthNameAbbr()],
            [$this->getNextMonthDigit()],

            [$same_month_as_last_month_different_year]
        ];
    }

    public function true_args(): array
    {
        return [
            [$this->getLastMonthDigit()],
            [$this->getLastMonthInt()],
            [$this->getLastMonthName()],
            [$this->getLastMonthNameAbbr()],
            [new DateTime('first day of last month')]
        ];
    }

}