<?php
use PHPUnit\Framework\TestCase;

class IsUInt64Test extends TestCase {

    /**
     * @test
     */
    public function uint64_test()
    {
        if (function_exists('bccomp')) {
            for ($i=0; $i < count($this->false_args()); $i++) {
                $arg = $this->false_args()[$i];
                $this->assertFalse(is_uint64($arg), "false_args[#$i] Val: " . strval($arg));
            }

            for ($i=0; $i < count($this->true_args()); $i++) {
                $arg = $this->true_args()[$i];
                $this->assertTrue(is_uint64($arg), "true_args[#$i] Val: " . strval($arg));
            }
        }
        else $this->markTestSkipped("Skipped due to bccomp not existing");
    }

    public function false_args(): array {
        return [
            '',
            null,
            '10000000.00',
            '10000000000000000000000000000000000',
            10000000000000000000000000000000000,
            '1.0E0',
            strval(PHP_INT_MAX + 1),
            strval(- (PHP_INT_MAX + 1)),
            -0.1,
            bcadd(C_ULONG_MAX, '1')
        ];
    }

    public function true_args() : array {
        return[
            0,
            '0',
            10000.00, //type juggling via php
            1.0E0, //type juggling via php
            10,
            pow(10,10),
            C_ULONG_MAX
        ];
    }

}