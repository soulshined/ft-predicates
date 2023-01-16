<?php
use FT\Predicates\Test\SimplePredicateTest;

class DateTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_date';

    public function false_args(): array {
        return [
            [''],
            [null],
            [12345],
        ];
    }

    public function true_args() : array {
        return[
            ['   2012-02-01'],
            ['2012-02-01'],
            ['2012-02-01T00:00Z'],
            ['T00:00Z']
        ];
    }

}