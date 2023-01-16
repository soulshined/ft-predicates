<?php

use FT\Predicates\Test\Dates\BaseDateTest;

class IsTodayTest extends BaseDateTest {

    protected const PREDICATE = 'is_today';

    public function false_args(): array
    {
        $same_month_day_different_month = new DateTime($this->getMonthDayInt() . " " . $this->getNextMonthName());
        $same_month_day_different_year = new DateTime($this->getMonthDayInt() . " " . $this->getMonthName() . " " . $this->getYearInt() + 1);

        return [
            [''],
            [null],
            [new DateTime('-1.5 days')],
            [new DateTime('-1 day')],
            [new DateTime('+1 day')],

            [$this->getYesterdayDayName()],
            [$this->getYesterdayDayNameAbbr()],
            [$this->getYesterdayMonthDayInt()],
            [$this->getTomorrowDayName()],
            [$this->getTomorrowDayNameAbbr()],
            [$this->getTomorrowMonthDayInt()],

            [$same_month_day_different_month],
            [$same_month_day_different_year],
        ];
    }

    public function true_args(): array
    {
        return [
            [new DateTime('-5 mins')],
            [new DateTime('today')],
            [new DateTime],
            [$this->getDayName()],
            [$this->getDayNameAbbr()],
            [$this->getMonthDayInt()],
        ];
    }

}