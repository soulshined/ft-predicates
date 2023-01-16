<?php

use PHPUnit\Framework\TestCase;

class PlatformTest extends TestCase {

    /**
     * @test
     */
    public function platform_test() {
        if (PHP_OS_FAMILY === 'Windows')
            $this->assertTrue(is_windows());
        else if (PHP_OS_FAMILY === 'Linuk')
            $this->assertTrue(is_linux());

        $this->assertFalse(is_darwin());
        $this->assertFalse(is_bsd());
        $this->assertFalse(is_solaris());
    }

}
