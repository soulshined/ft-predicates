<?php

namespace FT\Predicates\Locale;

use NumberFormatter;

final class Localeconv {
    public readonly string $DECIMAL_SYMBOL;
    public readonly string $PLUS_SYMBOL;
    public readonly string $MINUS_SYMBOL;
    public readonly string $GROUP_SEPARATOR;

    public function __construct(NumberFormatter $num)
    {
        $this->DECIMAL_SYMBOL = $num->getSymbol(NumberFormatter::DECIMAL_SEPARATOR_SYMBOL);
        $this->PLUS_SYMBOL = $num->getSymbol(NumberFormatter::PLUS_SIGN_SYMBOL);
        $this->MINUS_SYMBOL = $num->getSymbol(NumberFormatter::MINUS_SIGN_SYMBOL);
        $this->GROUP_SEPARATOR = $num->getSymbol(NumberFormatter::GROUPING_SEPARATOR_SYMBOL);
    }
}