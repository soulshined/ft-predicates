<?php
use FT\Predicates\Test\SimplePredicateTest;
use PHPUnit\Framework\TestCase;

class ContainsTest extends TestCase {

    /**
     * @test
     * @dataProvider contains_args
     */
    public function contains_test($needle, $haystack, $expected) {
        $this->assertEquals($expected, contains($needle, $haystack));
    }

    /**
     * @test
     * @dataProvider icontains_args
     */
    public function icontains_test($needle, $haystack, $expected) {
        $this->assertEquals($expected, icontains($needle, $haystack));
    }

    public function contains_args() : array {
        $obj = new stdClass;
        $obj->FOO = "foo";
        $obj->BaR = "bar";

        return[
            [null, ['haystack1', 'haystack2', null, 'NeedLe'], true],
            ['NeedLe', ['haystack1', 'haystack2', 'NeedLe'], true],
            ['needle', ['haystack1', 'haystack2', 'NeedLe'], false],
            [null, $obj, false],
            [null, "foobar", false],
            ["bar", $obj, false],
            ["abc", "123", false],
            ["1", "321", true],
            [123, "00123.00", true],
            ["world", "Hello World", false],
        ];
    }

    public function icontains_args() : array {
        $obj = new stdClass;
        $obj->FOO = "foo";
        $obj->BaR = "bar";

        return[
            [null, ['haystack1', 'haystack2', null, 'NeedLe'], true],
            ['NeedLe', ['haystack1', 'haystack2', 'NeedLe'], true],
            ['needle', ['haystack1', 'haystack2', 'NeedLe'], true],
            [null, $obj, false],
            [null, "foobar", false],
            ["bar", $obj, true],
            ["abc", "123", false],
            ["1", "321", true],
            [123, "00123.00", true],
            ["world", "Hello World", true],
        ];
    }

}