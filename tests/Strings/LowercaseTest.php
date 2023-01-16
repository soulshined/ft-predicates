<?php

use FT\Predicates\Test\SimplePredicateTest;

class LowercaseTest extends SimplePredicateTest {

    protected const PREDICATE = "is_lower";

    public function false_args(): array
    {
        return [
            [''],
            [null],
            ['aOeuhtns'],
            [1235],
        ];
    }

    public function true_args(): array
    {
        return [
            ['aoeu'],
            ['aoeu123'],
            ['   aoeu12  3'],
            ['   aoeu'],
            ['aoeu.htns']
        ];
    }

}

?>