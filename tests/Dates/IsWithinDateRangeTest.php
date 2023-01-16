<?php

use PHPUnit\Framework\TestCase;

final class IsWithinDateRangeTest extends TestCase {

    /**
    * @test
    * @dataProvider args
    */
    public function is_within_date_range_test($value, $format, $expected) {
        $this->assertEquals($expected, is_within_date_range($value, $format));
    }

    public function args() {
        return [
            ['', '-5 mins', false],
            [null, '-5 mins', false],
            [new DateTime('-1 hour'), '+-30 mins', false],
            [new DateTime('+1 hour'), '+-30 mins', false],
            [new DateTime('-15 min'), '+-30 mins', true],
            [new DateTime('+15 min'), '+-30 mins', true], // #5
            [new DateTime('+1 year'), '+-30 mins', false],
            [new DateTime('-10 mins'), '-30 mins', true],
            [new DateTime('+120 mins'), '-30 mins', false],
            [new DateTime('+120 mins'), '+30 mins', false],
            [new DateTime('+120 mins'), '30 mins', false], // #10
            [new DateTime('-25 mins'), '30 mins', true],
        ];
    }

}
