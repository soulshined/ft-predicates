<?php

use FT\Predicates\Test\Dates\BaseDateTest;

class IsTomorrowTest extends BaseDateTest {

    protected const PREDICATE = 'is_tomorrow';

    public function false_args(): array
    {
        $same_month_day_different_month = new DateTime($this->getTomorrowMonthDayInt() . " " . $this->getNextMonthName());
        $same_month_day_different_year = new DateTime($this->getTomorrowMonthDayInt() . " " . $this->getMonthName() . " " . $this->getYearInt() + 1);

        return [
            [''],
            [null],
            [new DateTime('-5 mins')],
            [new DateTime('-1.5 days')],
            [new DateTime('-1 day')],
            [$this->getMonthDayInt()],
            [$this->getDayName()],
            [$this->getDayNameAbbr()],
            [$this->getYesterdayDayName()],
            [$this->getYesterdayDayNameAbbr()],
            [$this->getYesterdayMonthDayInt()],

            [$same_month_day_different_month],
            [$same_month_day_different_year],
        ];
    }

    public function true_args(): array
    {
        return [
            [new DateTime('+1 day')],
            [$this->getTomorrowDayName()],
            [$this->getTomorrowDayNameAbbr()],
            [$this->getTomorrowMonthDayInt()],
        ];
    }

}