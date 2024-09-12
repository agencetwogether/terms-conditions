# This is my package terms-conditions

[![Latest Version on Packagist](https://img.shields.io/packagist/v/agencetwogether/terms-conditions.svg?style=flat-square)](https://packagist.org/packages/agencetwogether/terms-conditions)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/agencetwogether/terms-conditions/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/agencetwogether/terms-conditions/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/agencetwogether/terms-conditions/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/agencetwogether/terms-conditions/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/agencetwogether/terms-conditions.svg?style=flat-square)](https://packagist.org/packages/agencetwogether/terms-conditions)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require agencetwogether/terms-conditions
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="terms-conditions-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="terms-conditions-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="terms-conditions-views"
```

Add the `Agencetwogether\TermsConditions\Concerns\HasAcceptsTerms` trait to your User model(s):

```php
use Agencetwogether\TermsConditions\Concerns\HasAcceptsTerms;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasAcceptsTerms;

    // ...
}
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$termsConditions = new Agencetwogether\TermsConditions();
echo $termsConditions->echoPhrase('Hello, Agencetwogether!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Max](https://github.com/Max)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
