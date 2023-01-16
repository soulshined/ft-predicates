<?php

use FT\Predicates\Locale\i18n;
use FT\Predicates\Test\i18n\Locales\BaseLocaleTest;

/**
 * @group locale
 */
final class kr_KR_Test extends BaseLocaleTest {

    /**
     * @test
     */
    public function should_honor_dows_test() {
        //monday
        $this->assertTrue(is_weekday('월요일'));
        $this->assertFalse(is_weekend_day('월요일'));
        //tuesday
        $this->assertTrue(is_weekday('화요일'));
        $this->assertFalse(is_weekend_day('화요일'));
        //wednesday
        $this->assertTrue(is_weekday('수요일'));
        $this->assertFalse(is_weekend_day('수요일'));
        //thursday
        $this->assertTrue(is_weekday('목요일'));
        $this->assertFalse(is_weekend_day('목요일'));
        //friday
        $this->assertTrue(is_weekday('금요일'));
        $this->assertFalse(is_weekend_day('금요일'));
        //saturday
        $this->assertFalse(is_weekday('토요일'));
        $this->assertTrue(is_weekend_day('토요일'));
        //sunday
        $this->assertFalse(is_weekday('일요일'));
        $this->assertTrue(is_weekend_day('일요일'));
    }

    /**
    * @test
    */
    public function should_have_translated_dow_test() {
        $this->assertTrue(is_dayofweek('월요일'));
        $this->assertTrue(is_dayofweek('화요일'));
        $this->assertTrue(is_dayofweek('수요일'));
        $this->assertTrue(is_dayofweek('목요일'));
        $this->assertTrue(is_dayofweek('금요일'));
        $this->assertTrue(is_dayofweek('토요일'));
        $this->assertTrue(is_dayofweek('일요일'));
    }

    /**
     * @test
     */
    public function first_day_of_week_test()
    {
        $fdow = i18n::getFirstDayOfWeek();
        $this->assertEquals('Sunday', $fdow->display);
    }

    /**
    * @test
    */
    public function should_have_translated_month_test() {
        $this->assertTrue(is_month('일월'));
        $this->assertTrue(is_month('이월'));
        $this->assertTrue(is_month('삼월'));
        $this->assertTrue(is_month('사월'));
        $this->assertTrue(is_month('오월'));
        $this->assertTrue(is_month('유월'));
        $this->assertTrue(is_month('칠월'));
        $this->assertTrue(is_month('팔월'));
        $this->assertTrue(is_month('구월'));
        $this->assertTrue(is_month('시월'));
        $this->assertTrue(is_month('십일월'));
        $this->assertTrue(is_month('십이월'));
    }

    /**
    * @test
    */
    public function should_have_localconv_test() {
        $this->assertEquals('.', i18n::$localeconv->DECIMAL_SYMBOL);
        $this->assertEquals(',', i18n::$localeconv->GROUP_SEPARATOR);
        $this->assertEquals('-', i18n::$localeconv->MINUS_SYMBOL);
        $this->assertEquals('+', i18n::$localeconv->PLUS_SYMBOL);
    }


    /**
     * @test
     */
    public function is_actual_long_should_be_true_test()
    {
        $this->assertTrue(is_actual_float('1.5'));
        $this->assertFalse(is_actual_float('1,5'));
        $this->assertTrue(is_actual_float(1.5));
        $this->assertTrue(is_actual_float('1.'));
        $this->assertTrue(is_actual_float('.5'));
    }

    /**
     * @test
     */
    public function is_e_notation_test()
    {
        $this->assertTrue(is_e_notation('+5.000e0'));
        $this->assertTrue(is_e_notation('-5.000e0'));
        $this->assertTrue(is_e_notation('5.000e-0'));
        $this->assertTrue(is_e_notation('5.000e+0'));
    }
}