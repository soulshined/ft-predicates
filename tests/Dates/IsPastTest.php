<?php

use FT\Predicates\Test\Dates\BaseDateTest;

final class IsPastTest extends BaseDateTest {

    protected const PREDICATE = 'is_past';

    public function false_args(): array
    {
        return [
            [''],
            [null],
            [new DateTime('+50 ms')],
            [new DateTime('+1 day')],
        ];
    }

    public function true_args(): array
    {
        return [
            [new DateTime('-1 day')],
            [new DateTime('-1 sec')],
            ["2000-01-01"],
            ["2000-01-01T00:00"],
        ];
    }

}