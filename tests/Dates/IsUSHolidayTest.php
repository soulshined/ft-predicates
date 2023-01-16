<?php
use FT\Predicates\Test\SimplePredicateTest;

class IsUSHolidayTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_us_holiday';

    public function false_args(): array {
        return [
            [new DateTime('2023-01-02')],
            [new DateTime('2023-12-24')],
            [new DateTime('1869-01-01')],
            [new DateTime('2020-06-19')],
            [new DateTime('1869-07-04')],
            [new DateTime('1937-11-11')],
            [new DateTime('1869-12-25')],

            [new DateTime('2020-02-01')],
            [new DateTime('2020-05-01')],
            [new DateTime('2020-06-01')],
            [new DateTime('2020-07-01')],
            [new DateTime('2020-09-01')],
            [new DateTime('2020-10-01')],
            [new DateTime('2020-11-01')],
            [new DateTime('2020-12-01')],
        ];
    }

    public function true_args() : array {
        return[
            [new DateTime('2023-01-01')],
            [new DateTime('2023-01-16')],
            [new DateTime('2023-02-20')],
            [new DateTime('2023-05-29')],
            [new DateTime('2023-06-19')],
            [new DateTime('2023-07-04')],
            [new DateTime('2023-09-04')],
            [new DateTime('2023-10-09')],
            [new DateTime('2023-11-11')],
            [new DateTime('2023-11-23')],
            [new DateTime('2023-12-25')],
        ];
    }

}