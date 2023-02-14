<?php


namespace FT\Predicates\Test\i18n\Locales;

use PHPUnit\Framework\TestCase;

abstract class BaseLocaleTest extends TestCase {

    public const NARROW_NO_BREAK_SPACE = "\u{202F}";

    abstract public function should_honor_dows_test();
    abstract public function should_have_translated_dow_test();
    abstract public function first_day_of_week_test();
    abstract public function should_have_translated_month_test();
    abstract public function should_have_localconv_test();

    abstract public function is_actual_long_should_be_true_test();
    abstract public function is_e_notation_test();
}