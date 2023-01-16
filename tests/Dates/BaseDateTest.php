<?php


namespace FT\Predicates\Test\Dates;

use DateTime;
use FT\Predicates\Locale\i18n;
use FT\Predicates\Test\SimplePredicateTest;
use FT\Sets\Set;

abstract class BaseDateTest extends SimplePredicateTest {

    public function getDayName() : string {
        return (new DateTime('today'))->format('l');
    }

    public function getDayNameAbbr() : string {
        return (new DateTime('today'))->format('D');
    }

    public function getTomorrowDayName() : string {
        return (new DateTime('tomorrow'))->format('l');
    }

    public function getTomorrowDayNameAbbr() : string {
        return (new DateTime('tomorrow'))->format('D');
    }

    public function getYesterdayDayName() : string {
        return (new DateTime('yesterday'))->format('l');
    }

    public function getYesterdayDayNameAbbr() : string {
        return (new DateTime('yesterday'))->format('D');
    }

    public function getYearInt() : int {
        return (int) (new DateTime('today'))->format('Y');
    }

    public function getMonthInt() : int {
        return (int) (new DateTime('today'))->format('m');
    }

    public function getMonthDigit() : string {
        return (new DateTime('today'))->format('m');
    }

    public function getMonthName() : string {
        return (new DateTime('today'))->format('F');
    }

    public function getMonthNameAbbr() : string {
        return (new DateTime('today'))->format('M');
    }

    public function getNextMonthInt() : int {
        return (int) (new DateTime('first day of next month'))->format('m');
    }

    public function getNextMonthDigit() : string {
        return (new DateTime('first day of next month'))->format('m');
    }

    public function getNextMonthName() : string {
        return (new DateTime('first day of next month'))->format('F');
    }

    public function getNextMonthNameAbbr() : string {
        return (new DateTime('first day of next month'))->format('M');
    }

    public function getLastMonthInt() : int {
        return (int) (new DateTime('first day of last month'))->format('m');
    }

    public function getLastMonthDigit() : string {
        return (new DateTime('first day of last month'))->format('m');
    }

    public function getLastMonthName() : string {
        return (new DateTime('first day of last month'))->format('F');
    }

    public function getLastMonthNameAbbr() : string {
        return (new DateTime('first day of last month'))->format('M');
    }

    public function getMonthDayInt() : int {
        return (int) (new DateTime('today'))->format('d');
    }

    public function getYesterdayMonthDayInt() : int {
        return (int) (new DateTime('yesterday'))->format('d');
    }

    public function getTomorrowMonthDayInt() : int {
        return (int) (new DateTime('tomorrow'))->format('d');
    }

    public function getThisQuarterInt() : int {
        return (int) i18n::getDateFormatter()->formatObject(new DateTime, 'qqqqq');
    }

    public function getLastQuarterInt() : int {
        $this_quarter = (int) i18n::getDateFormatter()->formatObject(new DateTime, 'qqqqq');
        $last_quarter = $this_quarter - 1;
        if ($last_quarter < 1) $last_quarter = 4;
        return $last_quarter;
    }

    public function getNextQuarterInt() : int {
        $this_quarter = (int) i18n::getDateFormatter()->formatObject(new DateTime, 'qqqqq');
        $next_quarter = $this_quarter + 1;
        if ($next_quarter > 12) $next_quarter = 1;
        return $next_quarter;
    }

    public function getLastQuarterYear() : int {
        $this_quarter = (int) i18n::getDateFormatter()->formatObject(new DateTime, 'qqqqq');
        $last_quarter = $this_quarter - 1;
        $year = $this->getYearInt();
        if ($last_quarter < 1) --$year;

        return $year;
    }

    public function getNextQuarterYear() : int {
        $this_quarter = (int) i18n::getDateFormatter()->formatObject(new DateTime, 'qqqqq');
        $next_quarter = $this_quarter + 1;
        $year = $this->getYearInt();
        if ($next_quarter > 12) $year += 1;
        return $year;
    }

    public function getMonths() : Set
    {
        return new Set([
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ]);
    }
}