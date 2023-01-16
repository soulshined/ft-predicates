<?php

use FT\Predicates\Test\SimplePredicateTest;

class LTrimmedTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_ltrimmed';

    public function false_args(): array {
        return [
            [null],
            ['    aoeuhtns'],
            ['     aoeuhtns    '],
            ['      ']
        ];
    }

    public function true_args() : array {
        return[
            [''],
            ['aoeuhtns    '],
        ];
    }

}