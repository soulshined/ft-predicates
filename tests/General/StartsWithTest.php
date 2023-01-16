<?php
use PHPUnit\Framework\TestCase;

class StartsWithTest extends TestCase {

    /**
    * @test
    * @dataProvider starts_with_args
    */
    public function starts_with_test($needle, $haystack, $expected) {
        $this->assertEquals($expected, starts_with($needle, $haystack));
    }

    public function starts_with_args() : array {
        return[
            ['', ['aoeu'], false],
            ['aoeu', null, false],
            [null, ['aoeu'], false],
            ['htns', ['HTNS', 'AOEU'], false],
            ['1234', ['aoeuhtns1234'], false],
            ['1234', 'aoeuhtns1234', false],
            ['AOEU', 'aoeuhtns1234', false],
            ['1234', 1234, true],
            [1234, 98761234, false],
            ['hello', 'HELLO WORLD', false]
        ];
    }

    /**
    * @test
    * @dataProvider istarts_with_args
    */
    public function istarts_with_test($needle, $haystack, $expected) {
        $this->assertEquals($expected, istarts_with($needle, $haystack));
    }

    public function istarts_with_args() : array {
        return [
            ['', ['aoeu'], false],
            ['aoeu', null, false],
            [null, ['aoeu'], false],
            ['HTNS', ['htns', 'AOEU'], true],
            ['1234', ['aoeuhtns1234'], false],
            ['1234', 'aoeuhtns1234', false],
            ['AOEU', 'aoeuhtns1234', true],
            ['1234', 1234, true],
            [1234, 98761234, false],
            [987, 98761234, true],
            ['hello', 'HELLO WORLD', true]
        ];
    }

}