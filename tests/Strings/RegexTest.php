<?php
use FT\Predicates\Test\SimplePredicateTest;

class RegexTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_regex';

    public function false_args(): array {
        return [
            [''],
            [null],
            ['(\d+']
        ];
    }

    public function true_args() : array {
        return[
            ['\d+'],
            ['/\d+/'],
            ['/(?<group>.+)/']
        ];
    }

}