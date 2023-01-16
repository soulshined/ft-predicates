<?php

use FT\Predicates\Locale\i18n;
use FT\Predicates\Test\i18n\Locales\BaseLocaleTest;

/**
 * @group locale
 */
final class fr_FR_Test extends BaseLocaleTest
{

    /**
     * @test
     */
    public function should_honor_dows_test()
    {
        //monday
        $this->assertTrue(is_weekday('lundi'));
        $this->assertFalse(is_weekend_day('lundi'));
        //tuesday
        $this->assertTrue(is_weekday('mardi'));
        $this->assertFalse(is_weekend_day('mardi'));
        //wednesday
        $this->assertTrue(is_weekday('mercredi'));
        $this->assertFalse(is_weekend_day('mercredi'));
        //thursday
        $this->assertTrue(is_weekday('jeudi'));
        $this->assertFalse(is_weekend_day('jeudi'));
        //friday
        $this->assertTrue(is_weekday('vendredi'));
        $this->assertFalse(is_weekend_day('vendredi'));
        //saturday
        $this->assertFalse(is_weekday('samedi'));
        $this->assertTrue(is_weekend_day('samedi'));
        //sunday
        $this->assertFalse(is_weekday('dimanche'));
        $this->assertTrue(is_weekend_day('dimanche'));
    }

    /**
     * @test
     */
    public function should_have_translated_dow_test()
    {
        $this->assertTrue(is_dayofweek('lundi'));
        $this->assertTrue(is_dayofweek('mardi'));
        $this->assertTrue(is_dayofweek('mercredi'));
        $this->assertTrue(is_dayofweek('jeudi'));
        $this->assertTrue(is_dayofweek('vendredi'));
        $this->assertTrue(is_dayofweek('samedi'));
        $this->assertTrue(is_dayofweek('dimanche'));
    }

    /**
     * @test
     */
    public function first_day_of_week_test()
    {
        $fdow = i18n::getFirstDayOfWeek();
        $this->assertEquals('lundi', $fdow->display);
    }

    /**
     * @test
     */
    public function should_have_translated_month_test()
    {
        $this->assertTrue(is_month('janvier'));
        $this->assertTrue(is_month('février'));
        $this->assertTrue(is_month('mars'));
        $this->assertTrue(is_month('avril'));
        $this->assertTrue(is_month('mai'));
        $this->assertTrue(is_month('juin'));
        $this->assertTrue(is_month('juillet'));
        $this->assertTrue(is_month('août'));
        $this->assertTrue(is_month('septembre'));
        $this->assertTrue(is_month('octobre'));
        $this->assertTrue(is_month('novembre'));
        $this->assertTrue(is_month('décembre'));
    }

    /**
     * @test
     */
    public function should_have_localconv_test()
    {
        $this->assertEquals(',', i18n::$localeconv->DECIMAL_SYMBOL);
        $this->assertEquals(self::NARROW_NO_BREAK_SPACE, i18n::$localeconv->GROUP_SEPARATOR);
        $this->assertEquals('-', i18n::$localeconv->MINUS_SYMBOL);
        $this->assertEquals('+', i18n::$localeconv->PLUS_SYMBOL);
    }

    /**
    * @test
    */
    public function is_actual_long_should_be_true_test() {
        $this->assertTrue(is_actual_float('1,5'));
        $this->assertFalse(is_actual_float('1.5'));
        $this->assertTrue(is_actual_float(1.5));
        $this->assertTrue(is_actual_float('1,'));
        $this->assertTrue(is_actual_float(',5'));
    }

    /**
    * @test
    */
    public function is_e_notation_test() {
        $this->assertTrue(is_e_notation('+5,000e0'));
        $this->assertTrue(is_e_notation('-5,000e0'));
        $this->assertTrue(is_e_notation('5,000e-0'));
        $this->assertTrue(is_e_notation('5,000e+0'));
    }

}
