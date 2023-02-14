<?php

use FT\Predicates\Locale\i18n;
use FT\Predicates\Test\i18n\Locales\BaseLocaleTest;

/**
 * @group locale
 */
final class de_DE_Test extends BaseLocaleTest
{

    /**
     * @test
     */
    public function should_honor_dows_test()
    {
        //monday
        $this->assertTrue(is_weekday('montag'));
        $this->assertFalse(is_weekend_day('montag'));
        //tuesday
        $this->assertTrue(is_weekday('dienstag'));
        $this->assertFalse(is_weekend_day('dienstag'));
        //wednesday
        $this->assertTrue(is_weekday('mittwoch'));
        $this->assertFalse(is_weekend_day('mittwoch'));
        //thursday
        $this->assertTrue(is_weekday('donnerstag'));
        $this->assertFalse(is_weekend_day('donnerstag'));
        //friday
        $this->assertTrue(is_weekday('freitag'));
        $this->assertFalse(is_weekend_day('freitag'));
        //saturday
        $this->assertFalse(is_weekday('samstag'));
        $this->assertTrue(is_weekend_day('samstag'));
        //sunday
        $this->assertFalse(is_weekday('sonntag'));
        $this->assertTrue(is_weekend_day('sonntag'));
    }

    /**
     * @test
     */
    public function should_have_translated_dow_test()
    {
        $this->assertTrue(is_dayofweek('montag'));
        $this->assertTrue(is_dayofweek('dienstag'));
        $this->assertTrue(is_dayofweek('mittwoch'));
        $this->assertTrue(is_dayofweek('donnerstag'));
        $this->assertTrue(is_dayofweek('freitag'));
        $this->assertTrue(is_dayofweek('samstag'));
        $this->assertTrue(is_dayofweek('sonntag'));
    }

    /**
     * @test
     */
    public function first_day_of_week_test()
    {
        $fdow = i18n::getFirstDayOfWeek();
        $this->assertEquals('Montag', $fdow->display);
    }

    /**
     * @test
     */
    public function should_have_translated_month_test()
    {
        $this->assertTrue(is_month('januar'));
        $this->assertTrue(is_month('februar'));
        $this->assertTrue(is_month('märz'));
        $this->assertTrue(is_month('april'));
        $this->assertTrue(is_month('mai'));
        $this->assertTrue(is_month('juni'));
        $this->assertTrue(is_month('juli'));
        $this->assertTrue(is_month('august'));
        $this->assertTrue(is_month('september'));
        $this->assertTrue(is_month('oktober'));
        $this->assertTrue(is_month('november'));
        $this->assertTrue(is_month('dezember'));
    }

    /**
     * @test
     */
    public function should_have_localconv_test()
    {
        $this->assertEquals(',', i18n::$localeconv->DECIMAL_SYMBOL);
        $this->assertEquals('.', i18n::$localeconv->GROUP_SEPARATOR);
        $this->assertEquals('-', i18n::$localeconv->MINUS_SYMBOL);
        $this->assertEquals('+', i18n::$localeconv->PLUS_SYMBOL);
    }

    /**
     * @test
     */
    public function is_actual_long_should_be_true_test()
    {
        $this->assertTrue(is_actual_float('1,5'));
        $this->assertFalse(is_actual_float('1.5'));
        $this->assertTrue(is_actual_float(1.5));
        $this->assertTrue(is_actual_float('1,'));
        $this->assertTrue(is_actual_float(',5'));
    }

    /**
     * @test
     */
    public function is_e_notation_test()
    {
        $this->assertTrue(is_e_notation('+5,000e0'));
        $this->assertTrue(is_e_notation('-5,000e0'));
        $this->assertTrue(is_e_notation('5,000e-0'));
        $this->assertTrue(is_e_notation('5,000e+0'));
    }

}
