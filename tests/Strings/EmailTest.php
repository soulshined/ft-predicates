<?php
use FT\Predicates\Test\SimplePredicateTest;

class EmailTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_email';

    public function false_args(): array {
        return [
            [''],
            [null]
        ];
    }

    public function true_args() : array {
        return[
            ['example@example.com']
        ];
    }

}