<?php

use PHPUnit\Framework\TestCase;

class PHPTest extends TestCase {

    /**
     * @test
     * @dataProvider is_version_number_args
     */
    public function is_version_number_test($v, $expected) {
        $this->assertEquals($expected, is_version_number($v));
    }

    public function is_version_number_args() {
        return [
            ['5', true],
            ['5.', false],
            ['5.5', true],
            ['5.5.', false],
            ['5.5.5', true],
            ['5.5.5.', false],
            ['10.0.0', true]
        ];
    }

    /**
     * @test
     */
    public function version_test() {
        $this->assertFalse(is_past_version(""));
        $this->assertFalse(is_past_version(null));

        $this->assertTrue(is_past_version("5"));
        $this->assertTrue(is_past_version("5.0"));
        $this->assertTrue(is_past_version("5.0.0"));
        $this->assertFalse(is_past_version("10.0.0"));

        $min_current_version = join(".", [PHP_MAJOR_VERSION, PHP_MINOR_VERSION, 0]);
        $max_minor_version = join(".", [PHP_MAJOR_VERSION, PHP_MINOR_VERSION, 1_000_000]);
        $next_minor_version = join(".", [PHP_MAJOR_VERSION, PHP_MINOR_VERSION  +1, 2]);

        $this->assertTrue(is_current_version($min_current_version));
        $this->assertTrue(is_current_version($max_minor_version));
        $this->assertFalse(is_current_version($next_minor_version));
        $this->assertFalse(is_current_version(PHP_MAJOR_VERSION + 1));
        $this->assertFalse(is_current_version(PHP_MAJOR_VERSION - 1));

        $this->assertTrue(is_php8());
        $this->assertFalse(is_php7());
        $this->assertFalse(is_php6());
    }

}