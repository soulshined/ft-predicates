<?php

use FT\Predicates\Test\Dates\BaseDateTest;

final class IsFutureTest extends BaseDateTest {

    protected const PREDICATE = 'is_future';

    public function false_args(): array
    {
        return [
            [''],
            [null],
            [new DateTime],
            [new DateTime('-1 day')],
            [new DateTime('-1 min')],
            ["2000-01-01"],
            ["2000-01-01T00:00"],
        ];
    }

    public function true_args(): array
    {
        return [
            [new DateTime('+1 day')],
            [new DateTime('+5 mins')],
            ["2100-01-01"],
            ["2100-01-01T00:00"],
        ];
    }

}