<?php

namespace FT\Predicates\Locale;

final class i18nNumber {

    public static function is_float(string | int | float | null $value): bool
    {
        if (is_null($value)) return false;
        if (is_float($value)) return true;

        $dec = preg_quote(i18n::$localeconv->DECIMAL_SYMBOL);
        $plusminus = preg_quote(i18n::$localeconv->PLUS_SYMBOL . i18n::$localeconv->MINUS_SYMBOL);

        $ws = "\s*";
        $lnum = "[0-9]+";
        $dnum = "(([0-9]*)?$dec$lnum|$lnum$dec" . "[0-9]*)";
        $expn_dnum = "(($lnum|$dnum)[eE][$plusminus]?$lnum)";
        $float_num_string = $ws . "[$plusminus]?($dnum|$expn_dnum)$ws";
        return is_string($value) &&
            preg_match("/^$float_num_string$/", $value) === 1;
    }

    public static function is_int(string | int | float | null $value): bool
    {
        if (is_null($value)) return false;
        if (is_int($value)) return true;

        $ws = "\s*";
        $plusminus = preg_quote(i18n::$localeconv->PLUS_SYMBOL . i18n::$localeconv->MINUS_SYMBOL);
        $lnum = "[0-9]+";
        $int_num_string = $ws . "[$plusminus]?$lnum$ws";

        return is_string($value) &&
            preg_match("/^$int_num_string$/", $value) === 1;
    }

    public static function is_numeric($value): bool
    {
        if (
            is_null($value) or is_object($value) or
            is_array($value) or is_resource($value) or
            is_callable($value)
        )
            return false;
        if (is_numeric($value)) return true;

        $dec = preg_quote(i18n::$localeconv->DECIMAL_SYMBOL);
        $plusminus = preg_quote(i18n::$localeconv->PLUS_SYMBOL . i18n::$localeconv->MINUS_SYMBOL);

        $ws = "\s*";
        $lnum = "[0-9]+";
        $dnum = "(([0-9]*)?$dec$lnum|$lnum$dec" . "[0-9]*)";
        $expn_dnum = "(($lnum|$dnum)[eE][$plusminus]?$lnum)";
        $int_num_string = $ws . "[$plusminus]?$lnum$ws";
        $float_num_string = $ws . "[$plusminus]?($dnum|$expn_dnum)$ws";

        return is_string($value) &&
            preg_match("/^($int_num_string|$float_num_string)$/", $value) === 1;
    }

    public static function normalize(string $value): ?array
    {
        $dec = preg_quote(i18n::$localeconv->DECIMAL_SYMBOL);
        $plusminus = preg_quote(i18n::$localeconv->PLUS_SYMBOL . i18n::$localeconv->MINUS_SYMBOL);

        $lnum = "[0-9]+";
        $dnum = "(([0-9]*)?$dec$lnum|$lnum$dec" . "[0-9]*)";
        $expn_dnum = "(($lnum|$dnum)[eE][$plusminus]?$lnum)";
        $int_num_string = "[$plusminus]?$lnum";
        $float_num_string = "[$plusminus]?($dnum|$expn_dnum)";

        if (preg_match("/^$float_num_string$/", $value) === 1) {
            $value = mb_ereg_replace("/" . i18n::$localeconv->DECIMAL_SYMBOL . "/", ".", $value);
            $value = mb_ereg_replace("/" . i18n::$localeconv->PLUS_SYMBOL . "/", "+", $value);
            $value = mb_ereg_replace("/" . i18n::$localeconv->MINUS_SYMBOL . "/", "-", $value);
            return ['value' => $value, 'type' => 'float'];
        } else if (preg_match("/^$int_num_string$/", $value) === 1) {
            $value = mb_ereg_replace("/" . i18n::$localeconv->PLUS_SYMBOL . "/", "+", $value);
            $value = mb_ereg_replace("/" . i18n::$localeconv->MINUS_SYMBOL . "/", "-", $value);

            if (
                $value > 0 and $value > PHP_INT_MAX or
                $value < 0 and $value < PHP_INT_MIN
            )
                return ['value' => $value, 'type' => 'float'];

            return ['value' => $value, 'type' => 'int'];
        } else return null;
    }

    public static function resolve(string | int | float &$value): void
    {
        if (!is_string($value)) return;

        $value = trim($value);
        $normalized = self::normalize($value);

        if (is_null($normalized))
            throw new \Exception("A non well formed numeric value encountered: '$value'");

        if ($normalized['type'] === 'int')
            $value = intval($normalized['value']);

        else $value = floatval($normalized['value']);
    }
}