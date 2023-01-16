<?php
use FT\Predicates\Test\SimplePredicateTest;

class IsEmptyTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_empty';

    public function false_args(): array {
        $std = new stdClass;
        $std->foo = 'bar';

        return [
            ['       ,'],
            ['0001'],
            [['aoeu']],
            [$std],
            ['   aoeu   '],
        ];
    }

    public function true_args() : array {
        return[
            [''],
            ['    '],
            [null],
            [[]],
            [new stdClass],
            [new class {}],
            ['000'],
            [0],
            ['0']
        ];
    }

}