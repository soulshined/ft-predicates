<?php

namespace FT\Predicates\Configurations;

use Locale;
use ReflectionClass;

final class Configs
{
    public string $localeId;
    public ?string $timezoneId;

    private function __construct() { }

    public static function load() : Configs {
        $ini_env = getenv("ft.ini");

        if ($ini_env !== false)
            return static::loadFile($ini_env);

        /**
         * @var Configs
         */
        $class = (new ReflectionClass(Configs::class))->newInstanceWithoutConstructor();
        $class->setTimezone(getenv("ft.predicates.locale_timezone_strategy"));
        $class->setLocaleId(getenv("ft.predicates.locale_id_strategy"));
        return $class;
    }

    private static function loadDefaults() : Configs {
        /**
         * @var Configs
         */
        $class = (new ReflectionClass(Configs::class))->newInstanceWithoutConstructor();
        $class->localeId = ini_get('intl.default_locale') ?: 'en_US';
        $class->timezoneId = ini_get('date.timezone') ?: null;
        return $class;
    }

    private static function loadFile($path): Configs {
        $ini = parse_ini_file($path, true);

        if ($ini === false || !isset($ini['predicates']))
            return Configs::loadDefaults();

        $ini_section = $ini['predicates'];

        /**
         * @var Configs
         */
        $class = (new ReflectionClass(Configs::class))->newInstanceWithoutConstructor();

        $locale_id_strategy = 'php_ini';
        if (isset($ini_section['locale_id_strategy']))
            $locale_id_strategy = $ini_section['locale_id_strategy'];

        $class->setLocaleId($locale_id_strategy);

        $locale_tz_strategy = '';
        if (isset($ini_section['locale_timezone_strategy']))
            $locale_tz_strategy = $ini_section['locale_timezone_strategy'];
        $class->setTimezone($locale_tz_strategy);

        return $class;
    }

    private function setTimezone(string $strategy) {
        switch (strtolower($strategy)) {
            case 'php_ini':
                $this->timezoneId = ini_get('date.timezone') ?: null;
                break;
            case 'env_var':
                $this->timezoneId = getenv('ft.predicates.default_timezone') ?: null;
                break;

            default:
                $this->timezoneId = null;
                break;
        }
    }

    private function setLocaleId(string $strategy) {
        switch (strtolower($strategy)) {
            case 'http_accept_header' :
                $this->localeId = Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT'] ?? "en-US") ?: 'en_US';
                break;
            case 'env_var':
                $this->localeId = Locale::canonicalize(getenv('lang') ?: 'en_US');
                break;

            default:
                $this->localeId = Locale::canonicalize(ini_get('intl.default_locale') ?: 'en_US');
                break;
        }
    }
}
