<?php

use PHPUnit\Framework\TestCase;

class ServerTest extends TestCase {

    /**
     * @test
     * @dataProvider args
     */
    public function args_test($method, $arg, $expected)
    {
        $this->assertEquals($expected, call_user_func($method, $arg));
    }

    public function args(): array
    {
        return [
            ['is_http_method', '', false],
            ['is_http_method', '      ', false],
            ['is_http_method', 'poSt', true],
            ['is_http_method', null, false],
            ['is_http_method', 'gEt', true],
            ['is_http_method', 'puT', true],
            ['is_http_method', 'opTions', true],
            ['is_http_method', 'hEAd', true],
            ['is_http_method', 'deLete', true],
            ['is_http_method', 'coNNect', true],
            ['is_http_method', 'Trace', true],
            ['is_http_method', 'PATCH', true],

            ['is_http_post', null, false],
            ['is_http_post', 'pOst', true],
            ['is_http_post', 'get', false]
        ];
    }

    /**
     * @test
     */
    public function should_use_server_request_method_test() {
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $this->assertFalse(is_http_get());
        $this->assertFalse(is_http_options());
        $this->assertFalse(is_http_delete());
        $this->assertTrue(is_http_post());
    }
}