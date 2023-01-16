<?php

use FT\Predicates\Test\SimplePredicateTest;

class ENotationTest extends SimplePredicateTest {

    protected const PREDICATE = "is_e_notation";

    public function false_args() : array
    {
        return [
            [''],
            [null],
            [1e0],
            [1e+0],
            [1e-0],
            [-1e-0],
            [+1e-0],
            [-1e+0],
            [+1e+0],
            ['1235124512351204597612509812735'],
            [12351029385019275],
            [12351029385.],
            [12355019275.2351235235],
        ];
    }

    public function true_args() : array {
        return [
            [PHP_INT_MAX * 2],
            [PHP_FLOAT_MAX],
            ['1.0E0'],
            [6.022e23],
            [+6.022e23],
            [-6.022e23],
            [6.022E+239],
            [6.022E-239],
            [+6.022E-239],
            [+6.022E+239],
            [-6.022E-239],
            [-6.022E+239],

            [.022e23],
            [+.022e23],
            [-.022e23],
            [.022E+239],
            [.022E-239],
            [+.022E-239],
            [+.022E+239],
            [-.022E-239],
            [-.022E+239],

            [6.e23],
            [+6.e23],
            [-6.e23],
            [6.E+239],
            [6.E-239],
            [+6.E-239],
            [+6.E+239],
            [-6.E-239],
            [-6.E+239],
        ];
    }

}

?>