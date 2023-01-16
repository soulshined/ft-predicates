<?php
use FT\Predicates\Test\SimplePredicateTest;

class IsArmstrongTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_armstrong';

    public function false_args(): array {
        return [
            [''],
            [null],
            [-1],
            [0],
            ['0'],
            [0.1],
            ['115132219018763992565095597973971522402'],
            [115132219018763992565095597973971522401]
        ];
    }

    public function true_args() : array {
        return[
            ['1'],
            [54748],
            [32164049651],
            ['115132219018763992565095597973971522401']
        ];
    }

}