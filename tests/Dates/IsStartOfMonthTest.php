<?php
use FT\Predicates\Test\SimplePredicateTest;

class IsStartOfMonthTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_start_of_month';

    public function false_args(): array
    {
        return [
            [new DateTime('last day of this month')],
            [new DateTime('2023-01-16')],
        ];
    }

    public function true_args(): array
    {
        return [
            [new DateTime('first day of this month')],
            [new DateTime('second mon of this month')],
        ];
    }

}