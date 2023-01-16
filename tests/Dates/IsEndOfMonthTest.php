<?php
use FT\Predicates\Test\SimplePredicateTest;

class IsEndOfMonthTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_end_of_month';

    public function false_args(): array {
        return [
            [new DateTime('first day of this month')],
            [new DateTime('second mon of this month')],
        ];
    }

    public function true_args() : array {
        return[
            [new DateTime('last day of this month')],
            [new DateTime('2023-01-16')],
        ];
    }

}