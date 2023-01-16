<?php

namespace FT\Predicates\Test;

use PHPUnit\Framework\TestCase;

abstract class SimplePredicateTest extends TestCase {

    protected const PREDICATE = "";

    /**
    * @test
    * @dataProvider true_args
    */
    public function valid_args_test($i) {
        $this->assertTrue(call_user_func($this::PREDICATE, $i) === true, $this::PREDICATE . "(" . var_export($i,true) . ")");
    }

    /**
    * @test
    * @dataProvider false_args
    */
    public function invalid_args_test($i) {
        $this->assertFalse(call_user_func($this::PREDICATE, $i), $this::PREDICATE . "(" . var_export($i, true) . ")");
    }

    abstract function true_args() : array;
    abstract function false_args() : array;

}