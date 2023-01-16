<?php
use PHPUnit\Framework\TestCase;

class IsBetweenTest extends TestCase {

    /**
     * @test
     * @dataProvider args
     */
    public function is_between_test($value, $lower, $upper, $expected) {
        $this->assertEquals($expected, is_between($value, $lower, $upper));
    }

    public function args(): array {
        return [
            ['', -1, -1, false],
            [null, -1, -1, false],
            [1, -1, -1, false],
            [1, 0, 1, false],
            [1, 1, 2, false],

            [0, -1, 1, true],
            [1, 0, PHP_INT_MAX, true],
            [1., 0, PHP_INT_MAX, true],
            ['1.5', 0, PHP_INT_MAX, true],
            ['1.5', '1', PHP_INT_MAX, true],
        ];
    }

}