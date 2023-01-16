<?php

use FT\Predicates\Test\SimplePredicateTest;

class HasTextTest extends SimplePredicateTest {

    protected const PREDICATE = 'has_text';

    public function false_args(): array {
        return [
            [''],
            [null],
            [mb_chr(13)]
        ];
    }

    public function true_args() : array {
        return[
            ['aoeuhtns'],
            [12345],
            ['12345!@#$% '],
            ['!@#$% '],
            ['aoeuhtns' . mb_chr(13)]
        ];
    }

}