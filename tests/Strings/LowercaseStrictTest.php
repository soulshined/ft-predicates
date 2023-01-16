<?php

use FT\Predicates\Test\SimplePredicateTest;

class LowercaseStrictTest extends SimplePredicateTest {

    protected const PREDICATE = "is_lower_strict";

    public function false_args(): array
    {
        return [
            [''],
            [null],
            ['aoeuhtns123'],
            ['   aoeuhtns12  3'],
            ['   aoeu'],
            [1235],
            ['aOeuhtns'],
            ['aOeu.htns']
        ];
    }

    public function true_args(): array
    {
        return [
            ['aoeu'],
        ];
    }

}

?>