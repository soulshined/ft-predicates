<?php

namespace FT\Predicates\Locale;

use IntlChar;

final class i18nString {

    public static function tolower(string $value): string
    {
        $result = [];
        foreach (mb_str_split($value) as $chr) {
            $lower = IntlChar::tolower($chr);
            $result[] = is_null($lower) ? $chr : $lower;
        }

        return join($result);
    }

    public static function trim(?string $value): ?string
    {
        if (is_null($value)) return null;

        $chrs = mb_str_split($value);

        $i = 0;
        while ($i < count($chrs) && !IntlChar::isprint($chrs[$i]) && !IntlChar::isUWhiteSpace($chrs[$i])) {
            $i++;
        }

        $sliced = array_slice($chrs, $i);
        $i = count($sliced);
        while (--$i > -1 && !IntlChar::isprint($sliced[$i]) && !IntlChar::isUWhiteSpace($sliced[$i])) {
        }

        return join(array_slice($sliced, 0, $i + 1));
    }

    public static function normalize(
        $value,
        bool $only_printable = true,
        bool $remove_cntrl = false,
        bool $remove_whitespace = false,
        bool $remove_punc = false,
        bool $remove_digits = false
    ) {
        $result = [];
        foreach (mb_str_split($value ?? "") as $chr) {
            if ($only_printable) {
                if (IntlChar::isprint($chr)) {
                    if ($remove_whitespace && IntlChar::isUWhiteSpace($chr))
                        continue;
                    else if ($remove_punc && IntlChar::ispunct($chr))
                        continue;
                    else if ($remove_digits && IntlChar::isdigit($chr))
                        continue;

                    $result[] = $chr;
                }


                continue;
            }

            if ($remove_cntrl && IntlChar::iscntrl($chr))
                continue;
            else if ($remove_whitespace && IntlChar::isUWhiteSpace($chr))
                continue;
            else if ($remove_punc && IntlChar::ispunct($chr))
                continue;
            else if ($remove_digits && IntlChar::isdigit($chr))
                continue;

            $result[] = $chr;
        }

        return join(array_map(fn ($i) => IntlChar::chr($i), $result));
    }

}