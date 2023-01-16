<?php

use FT\Predicates\Test\SimplePredicateTest;

class PunctuationTest extends SimplePredicateTest {

    protected const PREDICATE = "is_punctuation";

    public function false_args(): array
    {
        return [
            [''],
            [null],
            ['a0euhtns'],
            [1235],
            ['   aoeu  $1,000'],
            ['   aoeu'],
            ['   aoeu!@#$%']
        ];
    }

    public function true_args(): array
    {
        return [
            ['!@#%^()[]{}'],
            ['...'],
            ['/.*/']
        ];
    }

    /**
     * @test
     * @dataProvider has_punc_true_args
     */
    public function valid_has_punc_test($i)
    {
        $this->assertTrue(has_punctuation($i));
    }

    public function has_punc_true_args()
    {
        return [
            ['aoeu $1,000'],
            ['a0eu.1'],
            ['a!@#$eu'],
        ];
    }

    /**
     * @test
     * @dataProvider has_punc_false_args
     */
    public function invalid_has_punc_test($i)
    {
        $this->assertFalse(has_punctuation($i));
    }

    public function has_punc_false_args()
    {
        return [
            [''],
            [null],
            [12345],
            ['aoeuHtns']
        ];
    }


}

?>