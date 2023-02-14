<?php

namespace FT\Predicates\Locale;

use Collator;
use DateTime;
use FT\Predicates\Configurations\Configs;
use IntlCalendar;
use IntlDateFormatter;
use IntlTimeZone;
use Locale;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use NumberFormatter;
use Monolog\Logger;

final class i18n
{
    private static array $ini = [];
    private static NumberFormatter $numFormatter;
    private static IntlDateFormatter $dateFormatter;
    public static Collator $collator;
    public static Localeconv $localeconv;

    private static array $MONTHS = [];
    private static array $WEEKDAYS = [];
    private static array $WEEKEND_DAYS = [];

    private static Configs $configs;
    private static Logger $logger;

    public static function load(): void
    {
        static::$logger = new Logger('ft.predicates.i18n');
        $stream_handler = new StreamHandler("php://stdout", getenv('ft.log_level') ?: Level::Info);
        $stream_handler->setFormatter(new LineFormatter("%channel% [%level_name%]: %message% %context%\n"));
        static::$logger->pushHandler($stream_handler);

        static::$configs = Configs::load();
        $locale = static::$configs->localeId;

        if (file_exists(__DIR__ . "/./$locale.ini")) {
            static::$ini = (array)parse_ini_file(__DIR__ . "/./$locale.ini");
        };

        static::$collator = new Collator($locale);
        static::$numFormatter = NumberFormatter::create($locale, NumberFormatter::DEFAULT_STYLE);
        static::$localeconv = new Localeconv(static::$numFormatter);

        static::$logger->debug("Loaded locale $locale", [
            'lang' => Locale::getPrimaryLanguage($locale) . " => " . Locale::getDisplayLanguage($locale),
            'region' => Locale::getRegion($locale) . " => " . Locale::getDisplayRegion($locale),
            'ini' => static::$ini,
            'localeconv' => get_object_vars(static::$localeconv)
        ]);

        $cal = IntlCalendar::createInstance(static::$configs->timezoneId, $locale);

        $fdow = $cal->getFirstDayOfWeek();
        static::$logger->debug("Initial cal fdow => $fdow");

        if (isset(static::$ini['first_day_of_week']) || $fdow === false) {
            $value = static::$ini['first_day_of_week'];
            if (is_int($value) && $value >= 1 && $value <= 7)
                $fdow = (int) $value;
        }

        if ($fdow !== $cal->getFirstDayOfWeek()) {
            static::$logger->debug("Overriding cal fdow => $fdow");
            $cal->setFirstDayOfWeek($fdow);
        }

        static::$dateFormatter = IntlDateFormatter::create(
            $locale,
            IntlDateFormatter::NONE,
            IntlDateFormatter::NONE,
            static::$configs->timezoneId,
            $cal
        );

        foreach (['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'] as $month) {
            $date = new DateTime("1 $month 2000");

            $element = new LocaleElement;

            $abbr = static::$dateFormatter->formatObject($date, 'MMM', $locale);
            $element->abbr = new LocaleElement($abbr);

            if (str_ends_with($abbr, '.'))
                $element->abbr = new LocaleElement(substr($abbr, 0, -1));

            $name = static::$dateFormatter->formatObject($date, 'MMMM', $locale);

            $element->identifier = strtolower($name);
            $element->display = $name;
            $element->misc['digit'] = static::$dateFormatter->formatObject($date, 'M', $locale);

            static::$logger->debug("Registered $month", [
                'name' => $element->identifier,
                'abbr' => $element->abbr->identifier,
                'displayName' => $name,
                'digit' => $element->misc['digit'],
            ]);

            static::$MONTHS[] = $element;
        }

        for ($i = IntlCalendar::DOW_SUNDAY; $i <= IntlCalendar::DOW_SATURDAY; $i++) {
            $date = new DateTime("midnight $i January 2023");

            $en_day_name= static::$dateFormatter->formatObject($date, 'EEEE');
            $day_name = static::$dateFormatter->formatObject($date, 'EEEE', $locale);

            $element = new LocaleElement($day_name);
            $element->abbr = new LocaleElement(static::$dateFormatter->formatObject($date, 'EEE', $locale));

            $digit_day_of_week = (int) static::$dateFormatter->formatObject($date, 'c', $locale);
            $element->misc['digit'] = $digit_day_of_week;
            $element->misc['first_day_of_week'] = $fdow === $i;

            $type = $cal->getDayOfWeekType($i);
            $is_weekday = $type === IntlCalendar::DOW_TYPE_WEEKDAY;
            static::$logger->debug("Registered $en_day_name =>", [
                'name' => $day_name,
                'dow type' => $type . " (" . ($is_weekday ? "WEEKDAY" : "WEEKEND")  . ")",
                'weekday digit' => $digit_day_of_week,
                'first_day_of_week' => $element->misc['first_day_of_week']
            ]);

            if ($is_weekday)
                static::$WEEKDAYS[] = $element;
            else static::$WEEKEND_DAYS[] = $element;
        }
    }

    public static function translate(string $message)
    {
        return static::$ini[$message] ?? $message;
    }

    public static function has_phrase(string $message)
    {
        return isset(static::$ini[$message]);
    }

    public static function _(string $message)
    {
        return static::translate($message);
    }

    public static function getPrimaryLanguage() : string {
        return Locale::getPrimaryLanguage(self::$configs->localeId);
    }

    public static function getTimezone(): IntlTimeZone
    {
        return static::$dateFormatter->getTimeZone();
    }

    public static function getNumberSymbol(int $symbol): string | false
    {
        return static::$numFormatter->getSymbol($symbol);
    }

    public static function getMonthInfo(?string $month_name): ?array
    {
        $month_name = strtolower($month_name);
        $element = null;

        foreach (static::$MONTHS as $e) {
            if ($e->identifier === $month_name) $element = $e;
        }

        if (is_null($element)) return null;

        $translation = null;
        if (static::has_phrase($element->identifier))
            $translation = static::translate($element->identifier);

        return [
            'element' => $element,
            'translation' => $translation
        ];
    }

    public static function getDayInfo(?string $day_name): ?array
    {
        $day_name = strtolower($day_name);
        $element = null;
        foreach (array_merge(static::$WEEKDAYS, static::$WEEKEND_DAYS) as $e) {
            if ($e->identifier === $day_name) $element = $e;
        }

        if ($element === null) return null;

        $translation = null;
        if (static::has_phrase($element->identifier))
            $translation = static::translate($element->identifier);

        return [
            'element' => $element,
            'translation' => $translation
        ];
    }

    public static function getFirstDayOfWeek(): LocaleElement
    {
        foreach (static::$WEEKDAYS as $day) {
            if ($day->misc['first_day_of_week'])
                return $day;
        }

        foreach (static::$WEEKEND_DAYS as $day) {
            if ($day->misc['first_day_of_week'])
                return $day;
        }
    }

    public static function getWeekdayDigits(): array
    {

        return array_map(fn ($i) => $i->misc['digit'], static::$WEEKDAYS);
    }

    public static function getWeekenddayDigits(): array
    {
        return array_map(fn ($i) => $i->misc['digit'], static::$WEEKEND_DAYS);
    }

    public static function getWeekdayNames(): array
    {
        $names = array_map(fn ($i) => $i->identifier, static::$WEEKDAYS);
        $translations = array_map('self::translate', $names);

        foreach ($names as $n) {
            if (self::has_phrase($n))
                $translations[] = $n;
        }

        return array_unique(array_merge($names, $translations));
    }

    public static function getWeekdayAbbrs(): array
    {
        return array_map(fn ($i) => $i->abbr->identifier, static::$WEEKDAYS);
    }

    public static function getWeekenddayNames(): array
    {
        $names = array_map(fn ($i) => $i->identifier, static::$WEEKEND_DAYS);
        $translations = array_map('self::translate', $names);

        return array_unique(array_merge(array_values($names), array_values($translations)));
    }

    public static function getWeekenddayAbbrs(): array
    {
        return array_map(fn ($i) => $i->abbr->identifier, static::$WEEKEND_DAYS);
    }

    public static function getMonthNames()
    {
        return array_unique(array_merge(array_map(fn ($i) => $i->identifier, static::$MONTHS), [
            self::translate('january'),
            self::translate('february'),
            self::translate('march'),
            self::translate('april'),
            self::translate('may'),
            self::translate('june'),
            self::translate('july'),
            self::translate('august'),
            self::translate('september'),
            self::translate('october'),
            self::translate('november'),
            self::translate('december'),
            'january',
            'february',
            'march',
            'april',
            'may',
            'june',
            'july',
            'august',
            'september',
            'october',
            'november',
            'december',
        ]));
    }

    public static function getMonthAbbrs()
    {
        return array_unique(array_merge(
            array_map(fn ($i) => $i->abbr->identifier, static::$MONTHS),
            [
                'jan',
                'feb',
                'mar',
                'apr',
                'may',
                'jun',
                'jul',
                'aug',
                'sep',
                'nov',
                'dec'
            ]
        ));
    }

    public static function getDateFormatter(string $pattern = ''): IntlDateFormatter
    {
        return static::$dateFormatter->create(
            static::$configs->localeId,
            IntlDateFormatter::NONE,
            IntlDateFormatter::NONE,
            static::$configs->timezoneId,
            null,
            $pattern
        );
    }

    public static function getCalendar(): IntlCalendar
    {
        return IntlCalendar::createInstance(static::getTimezone(), static::$configs->localeId);
    }

}