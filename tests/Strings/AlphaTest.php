<?php

use FT\Predicates\Test\SimplePredicateTest;

class AlphaTest extends SimplePredicateTest {

    protected const PREDICATE = "is_alpha";

    public function false_args(): array
    {
        return [
            [''],
            [null],
            ['a0euhtns'],
            [1235],
            ['aoeu.htns'],
            ['   aoeu  htns'],
            ['   aoeu']
        ];
    }

    public function true_args(): array
    {
        return [
            ['aoeu'],
        ];
    }

    /**
     * @test
     * @dataProvider has_alpha_true_args
     */
    public function valid_has_alpha_test($i)
    {
        $this->assertTrue(has_alpha($i));
    }

    public function has_alpha_true_args()
    {
        return [
            ['   aoeuhtns12  3'],
            ['a0eu.1'],
            ['   aoeuhtns'],
            ['a!@#$eu   '],
            ['a!@#$eu.']
        ];
    }

    /**
     * @test
     * @dataProvider has_alpha_false_args
     */
    public function invalid_has_alpha_test($i)
    {
        $this->assertFalse(has_alpha($i));
    }

    public function has_alpha_false_args()
    {
        return [
            [''],
            [null],
            ['!@#$%'],
            ['  1234 '],
            ['      ']
        ];
    }


}

?>