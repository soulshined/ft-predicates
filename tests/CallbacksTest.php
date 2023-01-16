<?php

use PHPUnit\Framework\TestCase;

final class CallbacksTest extends TestCase {

    /**
     * @test
     */
    public function array_filter_test() {

        $arr = ['a', null, 'b', 'c', 1, -1, 2, new stdClass];

        $this->assertEquals(
            [1, 2],
            array_values(array_filter($arr, is_and(is_not('is_object'), 'is_positive')))
        );

        $this->assertEquals(
            [],
            array_values(array_filter($arr, is_nn_and('is_null')))
        );

        $this->assertEquals(
            [2],
            array_values(array_filter($arr, is_and(is_not('is_object'), is_xor('is_positive', 'is_truthy'))))
        );
    }

    /**
    * @test
    */
    public function is_and_test() {
        $this->assertTrue(is_and('is_positive', 'is_natural', 'is_whole')(1));
        $this->assertTrue(is_and('is_positive', fn ($i) => $i !== 0)(1));
        $this->assertFalse(is_and(
            fn ($i) => $i !== 1,
            fn ($i) => $i === 1
        )(1));
    }

    /**
    * @test
    */
    public function is_nand_test() {
        $this->assertFalse(is_nand('is_positive', 'is_natural', 'is_whole')(1));
        $this->assertFalse(is_nand('is_positive', fn ($i) => $i !== 0)(1));
        $this->assertTrue(is_nand(
            fn ($i) => $i !== 1,
            fn ($i) => $i === 1
        )(1));
        $this->assertTrue(!is_and(
            fn ($i) => $i !== 1,
            fn ($i) => $i === 1
        )(1));
    }

    /**
    * @test
    */
    public function is_not_test() {
        $this->assertFalse(is_not('is_positive')(1));
        $this->assertFalse(is_not('is_positive')(1));
        $this->assertTrue(is_not('is_negative')(1));
        $this->assertTrue(is_not(is_and(
            fn ($i) => $i !== 1,
            fn ($i) => $i === 1
        ))(1));
        $this->assertTrue(!is_not(is_nand(
            fn ($i) => $i !== 1,
            fn ($i) => $i === 1
        ))(1));
    }

    /**
    * @test
    */
    public function is_xor_test() {
        /**
         * Truth table
         *
         * P   Q
         * T | T | F
         * T | F | T
         * F | T | T
         * F | F | F
         */
        $this->assertFalse(is_xor('is_positive', 'is_truthy')(1));
        $this->assertTrue(is_xor('is_positive', 'is_truthy')(5));
        $this->assertTrue(is_xor('is_zero', 'is_positive')(5));
        $this->assertFalse(is_xor('is_zero', 'is_negative')(5));
    }

    /**
    * @test
    */
    public function is_xnor_test() {
        /**
         * Truth table
         *
         * P   Q
         * T | T | T
         * T | F | F
         * F | T | F
         * F | F | T
         */
        $this->assertTrue(is_xnor('is_positive', 'is_truthy')(1));
        $this->assertFalse(is_xnor('is_positive', 'is_truthy')(5));
        $this->assertFalse(is_xnor('is_zero', 'is_positive')(5));
        $this->assertTrue(is_xnor('is_zero', 'is_negative')(5));
    }

    /**
    * @test
    */
    public function is_or_test() {
        /**
         * Truth table
         *
         * P   Q
         * T | T | T
         * T | F | T
         * F | T | T
         * F | F | F
         */
        $this->assertTrue(is_or('is_positive', 'is_truthy')(1));
        $this->assertTrue(is_or('is_positive', 'is_negative')(-1));
        $this->assertTrue(is_or('is_negative', 'is_zero')(0));
        $this->assertFalse(is_or('is_negative', 'is_positive')(0));

        $this->assertTrue(is_or('is_negative', 'is_positive', 'is_null', 'is_e_notation', 'is_zero')(0));
    }

    /**
    * @test
    */
    public function is_nor_test() {
        /**
         * Truth table
         *
         * P   Q
         * T | T | F
         * T | F | F
         * F | T | F
         * F | F | T
         */
        $this->assertFalse(is_nor('is_positive', 'is_truthy')(1));
        $this->assertFalse(is_nor('is_zero', 'is_negative')(0));
        $this->assertFalse(is_nor('is_zero', 'is_non_null')(1));
        $this->assertTrue(is_nor('is_zero', 'is_positive')(-1));
    }

}