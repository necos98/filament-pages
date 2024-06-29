# This is my package filament-pages

[![Latest Version on Packagist](https://img.shields.io/packagist/v/necos98/filament-pages.svg?style=flat-square)](https://packagist.org/packages/necos98/filament-pages)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/necos98/filament-pages/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/necos98/filament-pages/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/necos98/filament-pages/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/necos98/filament-pages/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/necos98/filament-pages.svg?style=flat-square)](https://packagist.org/packages/necos98/filament-pages)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require necos98/filament-pages
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-pages-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-pages-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-pages-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$pages = new Pages();
echo $pages->echoPhrase('Hello, Pages!');
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

- [necos98](https://github.com/necos98)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
