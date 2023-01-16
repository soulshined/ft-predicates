<?php
use FT\Predicates\Test\SimplePredicateTest;

class IsUInt32Test extends SimplePredicateTest {

    protected const PREDICATE = 'is_uint32';

    public function false_args(): array {
        return [
            [''],
            [null],
            ['10000000000000000000000000000000000'],
            [10000000000000000000000000000000000],
            [10000.01],
            ['2147483648.00'],
            [2147483648.00],
            [1.0E0],
            ['1.0E0'],
            [C_UINT_MAX + 1],
            [-1]
        ];
    }

    public function true_args() : array {
        return[
            [4_294_967_295],
            [0]
        ];
    }

}