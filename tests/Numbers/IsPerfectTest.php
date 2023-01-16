<?php
use FT\Predicates\Test\SimplePredicateTest;

class IsPerfectTest extends SimplePredicateTest {

    protected const PREDICATE = 'is_perfect';

    public function false_args(): array {
        return [
            [''],
            [null],
            [4],
            [-1],
            [7]
        ];
    }

    public function true_args() : array {
        return[
            [6],
            [28],
            [496],
            [8128],
            [33550336],
            [8589869056],
            [137438691328],
            [2305843008139952128],
            ['2658455991569831744654692615953842176'],
            ['191561942608236107294793378084303638130997321548169216']
        ];
    }

}