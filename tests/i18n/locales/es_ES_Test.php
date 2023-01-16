<?php

use FT\Predicates\Locale\i18n;
use FT\Predicates\Test\i18n\Locales\BaseLocaleTest;

/**
 * @group locale
 */
final class es_ES_Test extends BaseLocaleTest
{

    /**
     * @test
     */
    public function should_honor_dows_test()
    {
        //monday
        $this->assertTrue(is_weekday('lunes'));
        $this->assertFalse(is_weekend_day('lunes'));
        //tuesday
        $this->assertTrue(is_weekday('martes'));
        $this->assertFalse(is_weekend_day('martes'));
        //wednesday
        $this->assertTrue(is_weekday('miércoles'));
        $this->assertFalse(is_weekend_day('miércoles'));
        //thursday
        $this->assertTrue(is_weekday('jueves'));
        $this->assertFalse(is_weekend_day('jueves'));
        //friday
        $this->assertTrue(is_weekday('viernes'));
        $this->assertFalse(is_weekend_day('viernes'));
        //saturday
        $this->assertFalse(is_weekday('sábado'));
        $this->assertTrue(is_weekend_day('sábado'));
        //sunday
        $this->assertFalse(is_weekday('domingo'));
        $this->assertTrue(is_weekend_day('domingo'));
    }

    /**
     * @test
     */
    public function should_have_translated_dow_test()
    {
        $this->assertTrue(is_dayofweek('lunes'));
        $this->assertTrue(is_dayofweek('martes'));
        $this->assertTrue(is_dayofweek('miércoles'));
        $this->assertTrue(is_dayofweek('jueves'));
        $this->assertTrue(is_dayofweek('viernes'));
        $this->assertTrue(is_dayofweek('sábado'));
        $this->assertTrue(is_dayofweek('domingo'));
    }

    /**
     * @test
     */
    public function first_day_of_week_test()
    {
        $fdow = i18n::getFirstDayOfWeek();
        $this->assertEquals('lunes', $fdow->display);
    }

    /**
     * @test
     */
    public function should_have_translated_month_test()
    {
        $this->assertTrue(is_month('enero'));
        $this->assertTrue(is_month('febrero'));
        $this->assertTrue(is_month('marzo'));
        $this->assertTrue(is_month('abril'));
        $this->assertTrue(is_month('mayo'));
        $this->assertTrue(is_month('junio'));
        $this->assertTrue(is_month('julio'));
        $this->assertTrue(is_month('agosto'));
        $this->assertTrue(is_month('septiembre'));
        $this->assertTrue(is_month('octubre'));
        $this->assertTrue(is_month('noviembre'));
        $this->assertTrue(is_month('diciembre'));
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
