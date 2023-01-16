<?php
use PHPUnit\Framework\TestCase;

class EndsWithTest extends TestCase {

    /**
    * @test
    * @dataProvider ends_with_args
    */
    public function ends_with_test($needle, $haystack, $expected) {
        $this->assertEquals($expected, ends_with($needle, $haystack));
    }

    public function ends_with_args() : array {
        return[
            ['', ['aoeu'], false],
            ['aoeu', null, false],
            [null, ['aoeu'], false],
            ['aoeu', ['htns', 'AOEU'], false],
            ['1234', ['aoeuhtns1234'], false],
            ['1234', 'aoeuhtns1234', true],
            ['1234', 1234, true],
            [1234, 98761234, true],
            ['world', 'HELLO WORLD', false]
        ];
    }

    /**
    * @test
    * @dataProvider iends_with_args
    */
    public function iends_with_test($needle, $haystack, $expected) {
        $this->assertEquals($expected, iends_with($needle, $haystack));
    }

    public function iends_with_args() : array {
        return[
            ['', ['aoeu'], false],
            ['aoeu', null, false],
            [null, ['aoeu'], false],
            ['aoeu', ['htns', 'AOEU'], true],
            ['1234', ['aoeuhtns1234'], false],
            ['1234', 'aoeuhtns1234', true],
            ['1234', 1234, true],
            [1234, 98761234, true],
            ['world', 'HELLO WORLD', true]
        ];
    }

}