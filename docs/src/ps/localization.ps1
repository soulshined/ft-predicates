Write-Output @'

Most predicates are locale-aware; meaning they automatically adjust validations to the locale provided. For example, in United States, the decimal separator is a period (`.`) while in France it is a comma (`,`)

Therefore a predicate like `is_actual_float` would validate accordingly to the locale. In United States, `1.5` would return true while for France it would only be true if the comma was used: `1,5` and in United States, `1,5` would return false

Reasons why you would want to dynamically change locale is for many scenarios, most commonly is to load a page using the locale via `lang` env var or from the `HTTP_ACCEPT` header as to not use the server locale or php.ini value

### How ft/predicates Localization Works

> **Important** This package does not change any underlying configurations. Meaning, we do not call `setlocale` or `Locale::setDefault()`. We simply obtain the locale how you tell us and use that locale value within the scope of our needs

> Although this package does not change any configurations it tries it's best to align and honor normal php conventions, like obtaining the locale from php.ini for example

The order of which locale is obtained by this package is as follows:

- Default to [php.ini configurations](https://www.php.net/manual/en/intl.configuration.php)
- If an env variable `ft.ini` exists
    - Get ft.ini file using `getenv('ft.ini')`
    - If file exists
        - Retrieve the [`locale_id_strategy`](#anchor-ft.ini) value if it exists
        - Else use defaults
    - If file does not exist
        - Retrieve value from `getenv('ft.predicates.locale_id_strategy')` if it exists
        - Else use defaults

In short, you can either tell the package which locale to use by telling it where to look for that value using either an [ft.ini](#anchor-ft.ini) file or by setting the values directly using `putenv` or simply do nothing and it will use the php.ini values

Once the locale is established, all the locale-aware predicates will validate against that locale inherently.

> **Tip** There is no cross-locale support. Meaning, if a locale does not recognize English 'Monday' as a day of the week it would return false for something like `is_dayofweek()`. Conversely, if a locale does recognize english 'Monday' as a day of week and this package supports translations for that locale, the translations will also be provided. An example of that is `kr_KR` where either `is_dayofweek('Monday')` and `is_dayofweek('월요일')` would both return true

All locale-based logic is done using:

- [NumberFormatter](https://www.php.net/manual/en/class.numberformatter.php)
- [IntlCalendar](https://www.php.net/manual/en/class.intlcalendar.php)
- [IntlDateFormatter](https://www.php.net/manual/en/class.intldateformatter.php)
- [IntlChar](https://www.php.net/manual/en/class.intlchar.php)
- [Collator](https://www.php.net/manual/en/class.collator.php)

### List of supported locales

> **Note** All locales are supported that PHP supports (and the system)

It's hard to identify a complete list of supported locale identifiers because it heavily depends on the system. In fact, [PHP docs](https://www.php.net/manual/en/intl.configuration.php) state:

> It is not recommended that the default `intl.default_locale` ini setting be relied on, as its effective value depends on the server's environment

You can however explore the built-in ICU locales: https://icu4c-demos.unicode.org/icu-bin/locexp#language

The meaning of 'supported' locales has two variants in this package

- A supported locale in general means any PHP recognized locale will be honored for any locale-aware predicates. For example, all `DateTime` objects will be formatted using that locale naturally
- A 'supported' locale in the context of this package, means we have also added a translation file so that things like 'Monday' can be translated to the language of the provided locale when it is not an English language *and* the `IntlDateFormatter` returns an English value

### Dynamically Update Locale Identifiers

The following alternatives to php.ini configs are supported for dynamically obtaining the locale identifier

- Create an [ft.ini](#anchor-ft.ini) file and supply values there
    - Once created, tell the package where to look with:
      `putenv('ft.ini=<ft.ini path>')`
- Tell ft/predicates where to look via `putenv`
    - `putenv('ft.predicates.locale_id_strategy=<choice>')`
    - `putenv('ft.predicates.locale_timezone_strategy=<choice>')`

'@