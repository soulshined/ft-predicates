<?php

namespace FT\Predicates\Locale;

final class LocaleElement
{
    public ?LocaleElement $abbr;
    public string $identifier;
    public string $display;
    public array $misc = [ ];

    public function __construct(?string $identifier = null)
    {
        if ($identifier === null) return;
        $this->identifier = strtolower($identifier);
        $this->display = $identifier;
    }
}
