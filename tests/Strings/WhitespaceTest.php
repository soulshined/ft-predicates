<?php

use FT\Predicates\Test\SimplePredicateTest;

class WhitespaceTest extends SimplePredicateTest {

    protected const PREDICATE = "is_whitespace";

    protected const CR = 015;
    protected const LF = 012;
    protected const VT = 013;
    protected const TAB = 011;

    public function false_args(): array
    {
        return [
            [''],
            [null],
            ['a0euhtns' . mb_chr(self::LF)],
            [1235],
            ['aoeu.htns' . mb_chr(self::TAB)]
        ];
    }

    public function true_args(): array
    {
        return [
            ['   '],
            [mb_chr(self::TAB)],
            [mb_chr(self::LF) . mb_chr(self::TAB) . mb_chr(self::VT) . mb_chr(self::CR)]
        ];
    }

    /**
     * @test
     * @dataProvider has_whitespace_true_args
     */
    public function valid_has_whitespace_test($i)
    {
        $this->assertTrue(has_whitespace($i));
    }

    public function has_whitespace_true_args()
    {
        return [
            ['   aoeuhtns12  3'],
            ['a0eu.1' . mb_chr(self::LF)],
            ['a!@#$eu' . mb_chr(self::TAB)],
            ['a!@#$eu.' . mb_chr(self::VT)]
        ];
    }

    /**
     * @test
     * @dataProvider has_whitespace_false_args
     */
    public function invalid_has_whitespace_test($i)
    {
        $this->assertFalse(has_whitespace($i));
    }

    public function has_whitespace_false_args()
    {
        return [
            [''],
            [null],
            ['!@#$%'],
            [12345]
        ];
    }


}

?>