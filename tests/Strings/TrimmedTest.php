<?php
use FT\Predicates\Test\SimplePredicateTest;

class TrimmedTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_trimmed';

    public function false_args(): array {
        return [
            [null],
            ['      '],
            ['aoeuhtns '],
            [' aoeuhtns'],
        ];
    }

    public function true_args() : array {
        return[
            [''],
            ['!@%'],
            ['aoeuhtns'],
            ['aoeu   htns'],
        ];
    }

}