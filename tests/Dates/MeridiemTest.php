<?php

use PHPUnit\Framework\TestCase;

final class MeridiemTest extends TestCase {

    public function meridiem_times() {
        return [
            'T00:00 UTC', //midnight, night, am
            'T03:00 UTC', //night, am
            'T05:59 UTC', //night, am
            'T06:00 UTC', //morning, am
            'T11:59 UTC', //morning, am
            'T12:00 UTC', //afternoon, noon, pm
            'T12:59 UTC', //afternoon, noon, pm
            'T13:00 UTC', //afternoon, pm
            'T15:00 UTC', //afternoon, pm
            'T17:59 UTC', //afternoon, pm
            'T18:00 UTC', //evening, pm
            'T20:59 UTC', //evening, pm
            'T21:00 UTC', //night, pm
            'T23:59 UTC', //night, pm
            'T24:00 UTC', //is_midnight only - neither am nor pm as 24:00 is an invalid date
        ];
    }

    /**
    * @test
    */
    public function is_am_test() {
        $result = array_map(fn ($i) => is_am($i), $this->meridiem_times());

        $this->assertEquals($this->am_args(), $result);
    }

    public function am_args() {
        return [
            true, true, true,
            true, true,
            false, false, false, false, false,
            false, false,
            false, false,
            false
        ];
    }

    /**
     * @test
     */
    public function is_pm_test()
    {
        $result = array_map(fn ($i) => is_pm($i), $this->meridiem_times());

        $this->assertEquals($this->pm_args(), $result);
    }

    public function pm_args()
    {
        return [
            false, false, false,
            false, false,
            true, true, true, true, true,
            true, true,
            true, true,
            false
        ];
    }

    /**
     * @test
     */
    public function is_noon_test()
    {
        $result = array_map(fn ($i) => is_noon($i), $this->meridiem_times());

        $this->assertEquals($this->noon_args(), $result);
    }

    public function noon_args()
    {
        return [
            false, false, false,
            false, false,
            true, true, false, false, false,
            false, false,
            false, false,
            false
        ];
    }

    /**
     * @test
     */
    public function is_evening_test()
    {
        $result = array_map(fn ($i) => is_evening($i), $this->meridiem_times());

        $this->assertEquals($this->evening_args(), $result);
    }

    public function evening_args()
    {
        return [
            false, false, false,
            false, false,
            false, false, false, false, false,
            true, true,
            false, false,
            false
        ];
    }

    /**
     * @test
     */
    public function is_morning_test()
    {
        $result = array_map(fn ($i) => is_morning($i), $this->meridiem_times());

        $this->assertEquals($this->morning_args(), $result);
    }

    public function morning_args()
    {
        return [
            false, false, false,
            true, true,
            false, false, false, false, false,
            false, false,
            false, false,
            false
        ];
    }

    /**
     * @test
     */
    public function is_afternoon_test()
    {
        $result = array_map(fn ($i) => is_afternoon($i), $this->meridiem_times());

        $this->assertEquals($this->afternoon_args(), $result);
    }

    public function afternoon_args()
    {
        return [
            false, false, false,
            false, false,
            true, true, true, true, true,
            false, false,
            false, false,
            false
        ];
    }

    /**
     * @test
     */
    public function is_midnight_test()
    {
        $result = array_map(fn ($i) => is_midnight($i), $this->meridiem_times());

        $this->assertEquals($this->midnight_args(), $result);
    }

    public function midnight_args()
    {
        return [
            true, false, false,
            false, false,
            false, false, false, false, false,
            false, false,
            false, false,
            true
        ];
    }
}