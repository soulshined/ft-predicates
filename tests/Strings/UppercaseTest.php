<?php

use FT\Predicates\Test\SimplePredicateTest;

class UppercaseTest extends SimplePredicateTest {

    protected const PREDICATE = "is_upper";

    public function false_args(): array
    {
        return [
            [''],
            [null],
            ['aOeuhtns'],
            [1235],
            ['      aoeuhtns    ']
        ];
    }

    public function true_args(): array
    {
        return [
            ['AOEU'],
            ['AOEU123'],
            ['   AOEU12  3'],
            ['   AOEU'],
            ['AOEU.HTNS']
        ];
    }

}

?>