# Laravel Strong Password

This package provides a validator for ensuring strong passwords in Laravel applications.

<p align="center">
    <a href="https://styleci.io/repos/184076269"><img src="https://styleci.io/repos/184076269/shield" alt="StyleCI" /></a>
    <a href="https://packagist.org/packages/andrey-helldar/strong-password"><img src="https://img.shields.io/packagist/dt/andrey-helldar/strong-password.svg?style=flat-square" alt="Total Downloads" /></a>
    <a href="https://packagist.org/packages/andrey-helldar/strong-password"><img src="https://poser.pugx.org/andrey-helldar/strong-password/v/stable?format=flat-square" alt="Latest Stable Version" /></a>
    <a href="https://packagist.org/packages/andrey-helldar/strong-password"><img src="https://poser.pugx.org/andrey-helldar/strong-password/v/unstable?format=flat-square" alt="Latest Unstable Version" /></a>
    <a href="https://travis-ci.org/andrey-helldar/strong-password"><img src="https://travis-ci.org/andrey-helldar/strong-password.svg?branch=master" alt="Travis CI" /></a>
    <a href="LICENSE"><img src="https://poser.pugx.org/andrey-helldar/strong-password/license?format=flat-square" alt="License" /></a>
</p>


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
    if($this->app->environment() !== 'production') {
        $this->app->register(\Helldar\StrongPassword\ServiceProvider::class);
    }
}
```

Copy the package config to your local config with the publish command:
```
php artisan vendor:publish --provider="Helldar\Roles\ServiceProvider"
```

You can create the DB tables by running the migrations:
```
php artisan migrate
```

This command will create such `roles`, `permissions`, `user_roles` and `role_permissions` tables.


## Usage

### Rules

Now, a `Validator` facade is extended by few rules:

 * `psw_letters` - The password must include at least one letter.
 * `psw_case_diff` - The password must include both upper and lower case letters.
 * `psw_numbers` - The password must include at least one number.
 * `psw_symbols` - The password must include at least one symbol.
 * `psw_strong` - The password must contain at least two characters in the lower and upper registers, at least one digit and a special character (include  all rules: `psw_letters`, `psw_case_diff`, `psw_numbers` and `psw_symbols`).


### Example

```php
// 1
$validator = \Validator::make([
        'foo' => 'qwerty'
    ], [
        'foo' => 'psw_letters'
    ]);

$validator->passes(); // return `true`

// 2
$validator = \Validator::make([
        'bar' => 'qwerty'
    ], [
        'bar' => 'psw_case_diff'
    ]);

$validator->passes(); // return `false`

// 3
$validator = \Validator::make([
        'baz' => 'qweRTY123!#'
    ], [
        'baz' => 'psw_strong'
    ]);

$validator->passes(); // return `true`
```


## License

This package is released under the [MIT License](LICENSE).
