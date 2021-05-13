# Laravel Strong Password

This package provides a validator for ensuring strong passwords in Laravel applications.

[![StyleCI Status][badge_styleci]][link_styleci]
[![Github Workflow Status][badge_build]][link_build]
[![For Laravel][badge_laravel]][link_packagist]

[![Stable Version][badge_stable]][link_packagist]
[![Unstable Version][badge_unstable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![License][badge_license]][link_license]


> In Laravel, since version [8.39.0](https://github.com/laravel/framework/releases/tag/v8.39.0), you can use the standard [password](https://laravel.com/docs/8.x/validation#validating-passwords) functionality ([#36960](https://github.com/laravel/framework/pull/36960)).

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

You can also publish the config file to change implementations (ie. interface to specific class):

```
php artisan vendor:publish --provider="Helldar\StrongPassword\ServiceProvider"
```

## Usage

### Rules

Now, a `Validator` facade is extended by few rules:

* `psw_letters` - The field must include at least one letter.
* `psw_case_diff` - The field must include both upper and lower case letters.
* `psw_numbers` - The field must include at least one number.
* `psw_symbols` - The field must include at least one symbol.
* `psw_min_length` - The field must be at least ten characters.
* `psw_strong` - The field must contain at least two characters in the lower and upper registers, at least one digit and a special character, and at least ten
  characters (include all rules: `psw_letters`, `psw_case_diff`, `psw_numbers`, `psw_symbols` and `psw_min_length`).

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

### Validation in context

You can also perform condition checking inside your code by accessing the `Password` facade:

```php
use Helldar\StrongPassword\Facades\Password;

return Password::validate('qwerty');

return Password::errors('qwerty');

return Password::isAllow('qwerty');
```

For example, we will define the following rules in the [config/strong-password.php](config/strong-password.php) file:

```php
return [
    'min_length' => 27,

    'rules' => [
        'psw_letters',
        'psw_numbers',
        'psw_min_length',
    ],
];
```

Thus, we will get the following results:

```php
$password = 'qwerty';

return Password::validate($password);
// throw ValidationException

return Password::errors($password);
// return array:
// [
//     'password' => [
//         'The password must include at least one number.',
//         'The password must be at least twenty-seven characters.',
//     ]
// ]

return Password::isAllow($password);
// return false
```

and

```php
$password = 'qWeRtYuIoP[]#!123qWeRtYuIqwd';

return Password::validate($password);
// [
//     'password' => 'qWeRtYuIoP[]#!123qWeRtYuIqwd'
// ]

return Password::errors($password);
// return null

return Password::isAllow($password);
// return true
```

## License

This package is licensed under the [MIT License](LICENSE).


## For Enterprise

Available as part of the Tidelift Subscription.

The maintainers of `andrey-helldar/strong-password` and thousands of other packages are working with Tidelift to deliver commercial support and maintenance for the open source packages you use to build your applications. Save time, reduce risk, and improve code health, while paying the maintainers of the exact packages you use. [Learn more](https://tidelift.com/subscription/pkg/packagist-andrey-helldar-strong-password?utm_source=packagist-andrey-helldar-strong-password&utm_medium=referral&utm_campaign=enterprise&utm_term=repo).

[badge_styleci]:    https://styleci.io/repos/130698068/shield

[badge_build]:      https://img.shields.io/github/workflow/status/andrey-helldar/strong-password/phpunit?style=flat-square

[badge_laravel]:    https://img.shields.io/badge/Laravel-5.5+%20%7C%206.x%20%7C%207.x%20%7C%208.x-orange.svg?style=flat-square

[badge_stable]:     https://img.shields.io/github/v/release/andrey-helldar/strong-password?label=stable&style=flat-square

[badge_unstable]:   https://img.shields.io/badge/unstable-dev--master-orange?style=flat-square

[badge_downloads]:  https://img.shields.io/packagist/dt/andrey-helldar/strong-password.svg?style=flat-square

[badge_license]:    https://img.shields.io/packagist/l/andrey-helldar/strong-password.svg?style=flat-square

[link_styleci]:     https://github.styleci.io/repos/184076269

[link_build]:       https://github.com/andrey-helldar/strong-password/actions

[link_packagist]:   https://packagist.org/packages/andrey-helldar/strong-password

[link_license]:     LICENSE
