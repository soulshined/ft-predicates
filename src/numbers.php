<?php

use FT\Predicates\Locale\i18n;
use FT\Predicates\Locale\i18nNumber;

use function FT\Predicates\Deprecation\validate;
use function function_exists as exists;

define('C_BYTE_MAX', 127);
define('C_BYTE_MIN', -128);
define('C_UBYTE_MAX', 255);

define('C_SHORT_MAX', 32767);
define('C_SHORT_MIN', -32768);
define('C_USHORT_MAX', 65535);

define('C_INT_MAX', 2147483647);
define('C_INT_MIN', -2147483648);
define('C_UINT_MAX', 4294967295);

define('C_LONG_MAX', 9223372036854775807);
define('C_LONG_MIN', -9223372036854775808);

if (extension_loaded('bcmath')) {
    define('C_ULONG_MAX', '18446744073709551615');
}

if (extension_loaded('gmp')) {
    define('GMP_PRIME_FALSE', 0);
    define('GMP_PRIME_POSSIBLE', 1);
    define('GMP_PRIME_TRUE', 2);
}

foreach ([
    'is_even',
    'is_odd',
    'is_negative',
    'is_positive',
    'is_zero',
    'is_non_zero',
    'is_between',
    'is_in_range',
    'is_actual_int',
    'is_byte',
    'is_ubyte',
    'is_actual_byte',
    'is_short',
    'is_ushort',
    'is_actual_short',
    'is_int32',
    'is_uint32',
    'is_actual_long',
    'is_int64',
    'is_uint64',
    'is_actual_float',
    'is_natural',
    'is_whole',
    'is_prime',
    'is_perfect',
    'is_armstrong',
    'is_happy_number',
    'is_harshad',
    'is_factorion',
    'is_dudeney',
    'is_sum_product'
] as $fn) { validate($fn); }

if (!exists('is_even')) {
    function is_even(string | int | float | null $value) : bool {
        if (!i18nNumber::is_numeric($value)) return false;

        i18nNumber::resolve($value);

        if ($value == 0) return true;

        if (is_int($value))
            return ($value & 1) === 0;

        return fmod(floatval($value), 2) === 0.0;
    }
}

if (!exists('is_odd')) {
    function is_odd(string | int | float | null $value) : bool {
        if (!i18nNumber::is_numeric($value)) return false;

        return !is_even($value);
    }
}

if (!exists('is_negative')) {
    function is_negative(string | int | float | null $value): bool
    {
        if (!i18nNumber::is_numeric($value)) return false;
        i18nNumber::resolve($value);

        return $value < 0;
    }
}

if (!exists('is_positive')) {
    function is_positive(string | int | float | null $value): bool
    {
        if (!i18nNumber::is_numeric($value)) return false;
        i18nNumber::resolve($value);

        return $value > 0;
    }
}

if (!exists('is_zero')) {
    function is_zero(string | int | float | null $value): bool
    {
        if (!i18nNumber::is_numeric($value)) return false;
        i18nNumber::resolve($value);

        return $value == 0;
    }
}

if (!exists('is_non_zero')) {
    /**
     * @return true if the provided number is any number other then zero
     */
    function is_non_zero(string | int | float | null $value): bool
    {
        if (!i18nNumber::is_numeric($value)) return false;
        i18nNumber::resolve($value);

        return ($value <=> 0) !== 0;
    }
}

if (!exists('is_between')) {
    /**
     * @return true if `$value` is between two numbers (exclusive)
     */
    function is_between(string | int | float | null $value, string | int | float $a, string | int | float $b) : bool {
        if (!i18nNumber::is_numeric($value) || !i18nNumber::is_numeric($a) || !i18nNumber::is_numeric($b)) return false;
        i18nNumber::resolve($value);
        i18nNumber::resolve($a);
        i18nNumber::resolve($b);

        return $value > $a && $value < $b;
    }
}

if (!exists('is_in_range')) {
    /**
     * @return true if `$value` is between two numbers (inclusive)
     */
    function is_in_range(string | int | float | null $value, string | int | float $a, string | int | float $b) : bool {
        if (!i18nNumber::is_numeric($value) || !i18nNumber::is_numeric($a) || !i18nNumber::is_numeric($b)) return false;
        i18nNumber::resolve($value);
        i18nNumber::resolve($a);
        i18nNumber::resolve($b);

        return $value >= $a && $value <= $b;
    }
}

if (!exists('is_actual_short')) {
    /**
     * @return true if `C_SHORT_MIN >= $value <= C_SHORT_MAX` and is not an e-notated number/numeric string and is not a float, including `.00` floats
     */
    function is_actual_short(string | int | float | null $value) : bool
    {
        if (!i18nNumber::is_numeric($value) || is_actual_float($value)) return false;
        if (is_string($value) && is_e_notation($value)) return false;
        i18nNumber::resolve($value);

        return $value < 0
            ? $value >= C_SHORT_MIN
            : $value <= C_SHORT_MAX;
    }
}

if (!exists('is_short')) {
    /**
     * @alias for `is_actual_short()`
     */
    function is_short(string | int | float | null $value) : bool
    {
        return is_actual_short($value);
    }
}

if (!exists('is_ushort')) {
    /**
     * @return true if `0 >= $value <= C_USHORT_MAX` and is not an e-notated value
     */
    function is_ushort(string | int | float | null $value) : bool
    {
        if (!i18nNumber::is_numeric($value) || is_actual_float($value)) return false;
        if (is_string($value) && is_e_notation($value)) return false;
        i18nNumber::resolve($value);

        return $value > -1 && $value <= C_USHORT_MAX;
    }
}

if (!exists('is_actual_byte')) {
    /**
     * @return true if `C_BYTE_MIN >= $value <= C_BYTE_MAX` and is not e-notated number/numeric string and is not a float, including `.00` floats
     */
    function is_actual_byte(string | int | float | null $value) : bool
    {
        if (!i18nNumber::is_numeric($value) || i18nNumber::is_float($value)) return false;
        if (is_string($value) && is_e_notation($value)) return false;
        i18nNumber::resolve($value);

        return $value < 0
            ? $value >= C_BYTE_MIN
            : $value <= C_BYTE_MAX;
    }
}

if (!exists('is_byte')) {
    /**
     * @alias for `is_actual_byte()`
     */
    function is_byte(string | int | float | null $value) : bool
    {
        return is_actual_byte($value);
    }
}

if (!exists('is_ubyte')) {
    /**
     * @return true if `0 >= $value <= C_UBYTE_MAX` and is not an e-notated value
     */
    function is_ubyte(string | int | float | null $value) : bool
    {
        if (!i18nNumber::is_numeric($value) || is_actual_float($value)) return false;
        if (is_string($value) && is_e_notation($value)) return false;
        i18nNumber::resolve($value);

        return $value > -1 && $value <= C_UBYTE_MAX;
    }
}

if (!exists('is_actual_int')) {
    /**
     * @return true if `C_INT_MIN >= $value <= C_INT_MAX` and is not an e-notated number/numeric string and is not a float, including `.00` floats
     */
    function is_actual_int(string | int | float | null $value) : bool
    {
        if (!i18nNumber::is_numeric($value) || is_actual_float($value)) return false;
        if (is_string($value) && is_e_notation($value)) return false;
        i18nNumber::resolve($value);

        return $value < 0
            ? $value >= C_INT_MIN
            : $value <= C_INT_MAX;
    }
}

if (!exists('is_int32')) {
    /**
     * @alias for `is_actual_int()`
     */
    function is_int32(string | int | float | null $value) : bool {
        return is_actual_int($value);
    }
}

if (!exists('is_uint32')) {
    /**
     * @return true if `0 >= $value <= C_UINT_MAX` and is not an e-notated value
     */
    function is_uint32(string | int | float | null $value) : bool {
        if (!i18nNumber::is_numeric($value) || is_actual_float($value)) return false;
        if (is_string($value) && is_e_notation($value)) return false;
        i18nNumber::resolve($value);

        return $value > -1 && $value <= C_UINT_MAX;
    }
}

if (!exists('is_actual_long')) {
    /**
     * @return true if `C_LONG_MIN >= $value <= C_LONG_MAX` and is not an e-notated number/numeric string and is not a float
     */
    function is_actual_long(string | float | int | null $value): bool
    {
        if (!i18nNumber::is_numeric($value)) return false;

        if (is_string($value)) {
            if (is_e_notation($value)) return false;

            $minus = preg_quote(i18n::$localeconv->MINUS_SYMBOL);

            if (!mb_ereg_match("/^[$minus]?\d+$/", $value)) return false;
        }

        i18nNumber::resolve($value);

        if (is_float($value)) {
            if ($value >= 0 && $value < C_LONG_MAX)
                return false;
            else if ($value < 0 && $value >= C_LONG_MIN)
                return false;

            if (fmod($value, 2) !== 0.0) return false;
        }

        return $value < 0
            ? $value >= C_LONG_MIN
            : $value <= C_LONG_MAX;
    }
}

if (!exists('is_int64')) {
    /**
     * @alias for `is_actual_long()`
     */
    function is_int64(string | int | float | null $value) : bool {
        return is_actual_long($value);
    }
}

if (!exists('is_uint64') && extension_loaded('bcmath')) {
    /**
     * @return true if `0 >= $value <= C_ULONG_MAX` and is a string and only a string value compared by `bccomp` and is not an e-notated value
     */
    function is_uint64(string | int | float | null $value) : bool {
        $value = strval($value);
        if (!i18nNumber::is_numeric($value) || is_e_notation($value) || is_actual_float($value)) return false;
        $value = i18nNumber::normalize($value)['value'];

        return $value > -1 && bccomp($value, C_ULONG_MAX) !== 1;
    }
}

if (!exists('is_actual_float')) {
    /**
     * This method is decimal point locale-aware
     * @return true if the given number has decimals and is not an e_notated numeric string.
     */
    function is_actual_float(string | int | float | null $value): bool
    {
        if (!i18nNumber::is_numeric($value) || i18nNumber::is_int($value)) return false;

        if (is_string($value) && is_e_notation($value)) return false;

        return i18nNumber::is_float($value);
    }
}

if (!exists('is_natural')) {
    /**
     * @return true if `$value` is within all whole numbers - positive integers excluding zero. When a number exceeds `C_LONG_MAX` a 'natural number' is then considered as any float value with a `.00` scale. Returns false if `$value` is an e-notated value
     */
    function is_natural(string | int | float | null $value) : bool
    {
        if (!i18nNumber::is_numeric($value)) return false;

        if (is_string($value) && is_e_notation($value))
            return false;

        i18nNumber::resolve($value);

        if ($value < 1) return false;

        if (is_float($value) && $value < C_LONG_MAX)
            return false;

        return fmod(floatval($value), 1) === 0.0;
    }
}

if (!exists('is_whole')) {
    /**
     * @return true if `$value` is a natural number, including zero
     */
    function is_whole(string | int | float | null $value) : bool
    {
        if (!i18nNumber::is_numeric($value)) return false;
        if (is_natural($value)) return true;
        i18nNumber::resolve($value);

        return $value == 0;
    }
}

if (!exists('is_prime')) {
    /**
     * This method will attempt first to use built-in functions if they exist (bcmath, gmp)
     *
     * @return true if the provided value is a positive integer, or a numeric string without decimals and is not an e-notated number/numeric string
     * @see https://oeis.org/A000040
     */
    function is_prime(string | int | float | null $value) : bool {
        if (!i18nNumber::is_numeric($value)) return false;

        if (is_string($value) && is_e_notation($value))
            return false;
        else if (is_string($value) && is_actual_float($value)) return false;

        else if (is_string($value) && extension_loaded('bcmath')) {
            $value = i18nNumber::normalize($value)['value'];

            if ($value < 2) return false;

            $sqrt = bcsqrt($value);
            for ($i=2; $i < $sqrt; $i++)
                if (bcmod($value, $i) === 0) return false;

            return true;
        }

        i18nNumber::resolve($value);

        if ($value < 2) return false;

        $value = floatval($value);
        if (fmod($value, 1) !== 0.0) return false;

        if (extension_loaded('gmp'))
            return gmp_prob_prime($value) === GMP_PRIME_TRUE;

        for ($i=2; $i <= sqrt($value); $i++)
            if (fmod($value, $i) === 0.0) return false;

        return true;
    }
}

if (!exists('is_perfect')) {
    /**
     * A perfect number `n` is defined as any positive integer where the sum of its divisors minus the number itself equals the number. Implicitly follows `is_natural` requirements
     */
    function is_perfect(string | int | float | null $value) : bool {
        if (!is_natural($value)) return false;

        return in_array(strval($value),
            [
                '6',
                '28',
                '496',
                '8128',
                '33550336',
                '8589869056',
                '137438691328',
                '2305843008139952128',
                '2658455991569831744654692615953842176',
                '191561942608236107294793378084303638130997321548169216',
                '13164036458569648337239753460458722910223472318386943117783728128',
                '14474011154664524427946373126085988481573677491474835889066354349131199152128',
                '23562723457267347065789548996709904988477547858392600710143027597506337283178622239730365539602600561360255566462503270175052892578043215543382498428777152427010394496918664028644534128033831439790236838624033171435922356643219703101720713163527487298747400647801939587165936401087419375649057918549492160555646976',
                '141053783706712069063207958086063189881486743514715667838838675999954867742652380114104193329037690251561950568709829327164087724366370087116731268159313652487450652439805877296207297446723295166658228846926807786652870188920867879451478364569313922060370695064736073572378695176473055266826253284886383715072974324463835300053138429460296575143368065570759537328128',
                '54162526284365847412654465374391316140856490539031695784603920818387206994158534859198999921056719921919057390080263646159280013827605439746262788903057303445505827028395139475207769044924431494861729435113126280837904930462740681717960465867348720992572190569465545299629919823431031092624244463547789635441481391719816441605586788092147886677321398756661624714551726964302217554281784254817319611951659855553573937788923405146222324506715979193757372820860878214322052227584537552897476256179395176624426314480313446935085203657584798247536021172880403783048602873621259313789994900336673941503747224966984028240806042108690077670395259231894666273615212775603535764707952250173858305171028603021234896647851363949928904973292145107505979911456221519899345764984291328'
            ],
        );
    }
}

if (!exists('is_armstrong') && extension_loaded('bcmath')) {
    /**
     * An Armstrong number is the one whose value is equal to the sum of the cubes of its digits
     * This method assumes base 10
     *
     * @example - `153 = (1*1*1) + (5*5*5) + (3*3*3)`
     *
     * @return true if `$value` is an armstrong number. Implicitly follows `is_natural` requirements
     * @see https://oeis.org/A005188
     */
    function is_armstrong(string | int | float | null $value) : bool {
        if (!is_natural($value)) return false;

        $value = strval($value);

        if (is_e_notation($value)) return false;

        $digits = str_split($value);
        $qty = strval(count($digits));

        $sum = '0';

        foreach ($digits as $d)
            $sum = bcadd(bcpow($d, $qty), $sum);

        return bccomp($sum, $value) === 0;
    }
}

if (!exists('is_happy_number')) {
    /**
     * A happy number `n` is a natural numberthat eventually resolves to 1 when replaced by the sum of the square of each of its digits
     *
     * This method assumes base 10
     * @return true if `$value` is a happy number. Implicitly follows `is_natural` requirements
     * @see https://oeis.org/A007770
     */
    function is_happy_number(string | int | float | null $value) : bool {
        if (!is_natural($value)) return false;

        $value = i18nNumber::normalize(strval($value))['value'];

        while ($value != 4 && $value != 1)
            $value = array_sum(array_map(fn ($i) => $i**2, str_split(strval($value))));

        return $value == 1;
    }
}

if (!exists('is_harshad')) {
    /**
     * A harshard number `n` is a number which `n` is divisible by the sum of its digits
     * This method assumes base 10
     * @return true if `$value` is a harshad number. Implicitly follows `is_natural` requirements
     * @see https://oeis.org/A005349
     */
    function is_harshad(string | int | float | null $value) : bool {
        if (!is_natural($value)) return false;

        if (is_string($value))
            $value = i18nNumber::normalize($value)['value'];

        $n = floatval($value);

        $sum = 0.;
        while ($n>0) {
            $rem = fmod($n, 10);
            $sum += $rem;
            $n = floor(fdiv($n, 10));
        }

        return fmod($value, $sum) === 0.0;
    }
}

if (!exists('is_factorion')) {
    /**
     * A factorion number `n` is equal to the sum of the factorials of it's digits
     * @note this method assumes base 10
     */
    function is_factorion(string | int | float | null $value) : bool {
        if (is_null($value) || !i18nNumber::is_numeric($value) || is_negative($value)) return false;
        i18nNumber::resolve($value);

        return in_array((int)$value, [1,2,145,40585]);
    }
}

if (!exists('is_dudeney')) {
    /**
     * A dudeney number `n` is a natural number where the sum of its digits is equal to cube root of `n`
     *
     * @note this method assumes base 10
     * @see https://oeis.org/A061209
     */
    function is_dudeney(string | int | float | null $value) : bool {
        if (is_null($value) || !i18nNumber::is_numeric($value) || is_negative($value)) return false;
        i18nNumber::resolve($value);

        return in_array((int)$value, [0, 1,512,4913,5832,17576,19683]);
    }
}

if (!exists('is_sum_product')) {
    /**
     * A sum-product number is a number `n` such that the sum of `n's` digits times the product of `n's` digit is `n` itself
     */
    function is_sum_product(string | int | float | null $value) : bool {
        if (is_null($value) || !i18nNumber::is_numeric($value) || is_negative($value)) return false;
        i18nNumber::resolve($value);

        return in_array((int)$value, [0, 1,135,144]);
    }
}