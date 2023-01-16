<?php

use FT\Predicates\Test\SimplePredicateTest;

class DigitsTest extends SimplePredicateTest
{

    protected const PREDICATE = "is_digit";

    public function false_args(): array
    {
        return [
            [''],
            [null],
            ['aoeuhtns123'],
            ['   aoeuhtns12  3'],
            ['   aoeu'],
            ['1235   '],
            ['aOeuhtns'],
            ['aOeu.htns']
        ];
    }

    public function true_args(): array
    {
        return [
            ['1234'],
            [1235],
        ];
    }

    /**
     * @test
     * @dataProvider has_digit_true_args
     */
    public function valid_has_digit_test($i) {
        $this->assertTrue(has_digit($i));
    }

    public function has_digit_true_args() {
        return [
            ['   aoeuhtns12  3'],
            ['1235   '],
            ['a0eu.1']
        ];
    }

    /**
     * @test
     * @dataProvider has_digit_false_args
     */
    public function invalid_has_digit_test($i) {
        $this->assertFalse(has_digit($i));
    }

    public function has_digit_false_args() {
        return [
            ['   aoeuhtns'],
            ['a!@#$eu   '],
            ['a!@#$eu.']
        ];
    }

}
