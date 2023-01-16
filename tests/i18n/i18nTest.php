<?php

use FT\Predicates\Locale\i18n;
use PHPUnit\Framework\TestCase;

final class i18nTest extends TestCase {

    /**
    * @test
    */
    public function weekday_test() {
        $this->assertEquals([
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday'
        ], i18n::getWeekdayNames());

        $this->assertEquals([
            'mon',
            'tue',
            'wed',
            'thu',
            'fri'
        ], i18n::getWeekdayAbbrs());
    }

    /**
    * @test
    */
    public function weekend_test() {
        $this->assertEquals([
            'sunday',
            'saturday',
        ], i18n::getWeekenddayNames());

        $this->assertEquals([
            'sun',
            'sat',
        ], i18n::getWeekenddayAbbrs());
    }

}