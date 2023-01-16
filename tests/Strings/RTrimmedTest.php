<?php

use FT\Predicates\Test\SimplePredicateTest;

class RTrimmedTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_rtrimmed';

    public function false_args(): array {
        return [
            [null],
            ['aoeuhtns    '],
            ['     aoeuhtns    '],
            ['      ']
        ];
    }

    public function true_args() : array {
        return[
            [''],
            ['     aoeuhtns'],
        ];
    }

}