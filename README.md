# Laravel Strong Password

This package provides a validator for ensuring strong passwords in Laravel applications.

[![StyleCI Status][badge_styleci]][link_styleci]
[![Github Workflow Status][badge_build]][link_build]
[![For Laravel][badge_laravel]][link_packagist]

[![Stable Version][badge_stable]][link_packagist]
[![Unstable Version][badge_unstable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![License][badge_license]][link_license]


## Contents

* [Installation](#installation)
* [Usage](#usage)
    * [Rules](#rules)
    * [Example](#example)
* [License](#license)


## Installation

To get the latest version of Laravel Strong Password, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require andrey-helldar/strong-password
```

Or manually update `require` block of `composer.json` and run `composer update`.

```json
{
    "require-dev": {
        "andrey-helldar/strong-password": "^1.0"
    }
}
```

If you don't use auto-discovery, add the ServiceProvider to the providers array in `app/Providers/AppServiceProvider.php`:

```php
public function register()
{
    $this->app->register(\Helldar\StrongPassword\ServiceProvider::class);
}
```


## Usage

### Rules

Now, a `Validator` facade is extended by few rules:

 * `psw_letters` - The field must include at least one letter.
 * `psw_case_diff` - The field must include both upper and lower case letters.
 * `psw_numbers` - The field must include at least one number.
 * `psw_symbols` - The field must include at least one symbol.
 * `psw_min_length` - The field must be at least ten characters.
 * `psw_strong` - The field must contain at least two characters in the lower and upper registers, at least one digit and a special character, and at least ten characters (include  all rules: `psw_letters`, `psw_case_diff`, `psw_numbers`, `psw_symbols` and `psw_min_length`).


### Example

```php
// 1
$validator = \Validator::make(['foo' => 'qwerty'], ['foo' => 'psw_letters']);
$validator->passes(); // return `true`

// 2
$validator = \Validator::make(['bar' => 'qwerty'], ['bar' => 'psw_case_diff']);
$validator->passes(); // return `false`

// 3
$validator = \Validator::make(['baz' => 'qweRTY123!#'], ['baz' => 'psw_strong']);
$validator->passes(); // return `true`

// 4
$validator = \Validator::make(['baz' => 'qweRTY123!#'], ['baz' => 'psw_letters|psw_min_length']);
$validator->passes(); // return `true`
```


[badge_styleci]:    https://styleci.io/repos/130698068/shield
[badge_build]:      https://img.shields.io/github/workflow/status/andrey-helldar/strong-password/phpunit?style=flat-square
[badge_laravel]:    https://img.shields.io/badge/Laravel-5.5.x%20%7C%206.x%20%7C%207.x%20%7C%208.x-orange.svg?style=flat-square
[badge_stable]:     https://img.shields.io/github/v/release/andrey-helldar/strong-password?label=stable&style=flat-square
[badge_unstable]:   https://img.shields.io/badge/unstable-dev--master-orange?style=flat-square
[badge_downloads]:  https://img.shields.io/packagist/dt/andrey-helldar/strong-password.svg?style=flat-square
[badge_license]:    https://img.shields.io/packagist/l/andrey-helldar/strong-password.svg?style=flat-square

[link_styleci]:     https://github.styleci.io/repos/184076269
[link_build]:       https://github.com/andrey-helldar/strong-password/actions
[link_packagist]:   https://packagist.org/packages/andrey-helldar/strong-password
[link_license]:     LICENSE
