<?php

use FT\Predicates\Test\Dates\BaseDateTest;

class IsThisMonthTest extends BaseDateTest {

    protected const PREDICATE = 'is_this_month';

    public function false_args(): array
    {
        $same_month_as_this_month_different_year =
            new DateTime("01 " . $this->getMonthName() . " " . $this->getYearInt() + 2);

        return [
            [''],
            [null],
            [13],
            [0],
            [-1],
            [new DateTime('-35 days')],
            [new DateTime('+1 months')],

            [$same_month_as_this_month_different_year],
        ];
    }

    public function true_args(): array
    {
        return [
            [$this->getMonthDigit()],
            [$this->getMonthInt()],
            [$this->getMonthName()],
            [$this->getMonthNameAbbr()],
            [new DateTime('-5 mins')],
            [new DateTime('today')],
            [new DateTime]
        ];
    }

}