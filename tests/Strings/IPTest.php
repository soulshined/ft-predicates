<?php
use FT\Predicates\Test\SimplePredicateTest;

class IPTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_ip';

    public function false_args(): array {
        return [
            [''],
            [null],
            ['localhost:8080']
        ];
    }

    public function true_args() : array {
        return[
            ['2001:0db8:85a3:08d3:1319:8a2e:0370:7334'],
            ['::1']
        ];
    }

}