A simple, lightweight, dependency free PHP library for predicates and callbacks for dates, strings, numbers, versions etc

## Features
- Suite of predicates
- Convienence callbacks for things like easier array filtering
- No namespace means no worrying about use statements and qualifying function names
- Deprecation notices for when/if php adds a new function by the same name
- Built-in locale awareness (internationalization) for most predicates
- Predicate Categories
     - General Use
     - Dates
     - Numbers
     - Strings
     - PHP (versions)
     - Platform
     - Server
     - Callbacks

## Usage

- Ensure to have intl extension enabled in your php.ini
- `> composer require ft/predicates`

## Examples

```php
$array = [null,0,1,2,3,4,5,'one','two'];

array_filter($array, 'is_positive'); // [1,2,3,4,5]
array_filter($array, is_and('is_positive', is_not('is_truthy'))); // [2,3,4,5]
array_filter($array, is_xor('is_positive', 'is_truthy')); // [2,3,4,5]
```

```php
is_month_name("january") //true
```

A lot of effort has been put into making the predicates locale aware. An example of built-in support:

```php
putenv("lang=kr_KR");

is_month_name('february') //true
is_month_name('이월') //true
```

> **Note**
> Not all languages may be supported, as this is a work in progress. To help us add support, please submit a language [in discussions](https://github.com/soulshined/ft-predicates/discussions/categories/locale-request)!

For verbose documentation, see the [documentation page](https://soulshined.github.io/ft-predicates/)

To request a new predicate, feature or locale support - review the [discussion contributing guidelines](https://github.com/soulshined/ft-predicates/discussions/1)