<?php

use FT\Predicates\Test\Dates\BaseDateTest;

class IsThisQuarterTest extends BaseDateTest {

    protected const PREDICATE = 'is_this_quarter';

    public function false_args(): array
    {
        $first_month_next_quarter = $this->getNextQuarterInt() * 3 - 2;
        $next_quarter_date_as_str = sprintf("%s-%s-01T00:00+00:00", $this->getNextQuarterYear(), $first_month_next_quarter);

        $first_month_last_quarter = $this->getLastQuarterInt() * 3 - 2;
        $last_quarter_date_as_str = sprintf("%s-%s-01T00:00+00:00", $this->getLastQuarterYear(), $first_month_last_quarter);

        $first_month_this_quarter = $this->getThisQuarterInt() * 3 - 2;
        $same_quarter_as_this_quarter_different_year = sprintf("%s-%s-01T00:00+00:00", $this->getYearInt() + 2, $first_month_this_quarter);

        return [
            [''],
            [null],
            [$this->getNextQuarterInt()],
            [$this->getLastQuarterInt()],
            [$last_quarter_date_as_str],
            [$next_quarter_date_as_str],

            [$same_quarter_as_this_quarter_different_year],
        ];
    }

    public function true_args(): array
    {
        $first_month_this_quarter = $this->getThisQuarterInt() * 3 - 2;
        $this_quarter_date_as_str = sprintf("%s-%s-01T00:00+00:00", $this->getYearInt(), $first_month_this_quarter);

        return [
            [$this->getThisQuarterInt()],
            [$this_quarter_date_as_str]
        ];
    }

}