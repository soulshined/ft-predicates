<?php

use FT\Predicates\Test\Dates\BaseDateTest;

class IsYesterdayTest extends BaseDateTest {

    protected const PREDICATE = 'is_yesterday';

    public function false_args(): array {

        $same_month_day_different_month = new DateTime($this->getYesterdayMonthDayInt() . " " . $this->getNextMonthName());
        $same_month_day_different_year = new DateTime($this->getYesterdayMonthDayInt() . " " . $this->getMonthName() . " " . $this->getYearInt() + 1);

        return [
            [''],
            [null],
            [new DateTime('-5 mins')],
            [new DateTime('-1.5 days')],
            [new DateTime('+1 day')],
            [$this->getMonthDayInt()],
            [$this->getDayName()],
            [$this->getDayNameAbbr()],
            [$this->getTomorrowDayName()],
            [$this->getTomorrowDayNameAbbr()],
            [$this->getTomorrowMonthDayInt()],

            [$same_month_day_different_month],
            [$same_month_day_different_year],
        ];
    }

    public function true_args() : array {
        return[
            [new DateTime('-1 day')],
            [$this->getYesterdayMonthDayInt()],
            [$this->getYesterdayDayNameAbbr()],
            [$this->getYesterdayDayName()]
        ];
    }

}