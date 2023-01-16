<?php
use FT\Predicates\Test\SimplePredicateTest;

class USPhoneTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_us_phone';

    public function false_args(): array {
        return [
            [''],
            [null],
            ['0001234567'],
            ['000 123 4567'],
            ['000.123.4567'],
            ['000-123-4567'],
            ['234567.8910'],
            ['234 567-8910'],
            ['234.567 8910'],
            ['234-567 8910'],
        ];
    }

    public function true_args() : array {
        return[
            ['4567890'],
            ['456 7890'],
            ['456-7890'],
            ['456.7890'],
            [2345678910],
            ['2345678910'],
            ['234 456 7890'],
            ['234.456.7890'],
            ['234-456-7890'],
        ];
    }

}