# Laravel Pulse cards for Spatie Activity Log

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ejntaylor/activitylog-pulse.svg?style=flat-square)](https://packagist.org/packages/ejntaylor/activitylog-pulse)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/ejntaylor/activitylog-pulse/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/ejntaylor/activitylog-pulse/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ejntaylor/activitylog-pulse/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/ejntaylor/activitylog-pulse/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ejntaylor/activitylog-pulse.svg?style=flat-square)](https://packagist.org/packages/ejntaylor/activitylog-pulse)

This displays Logs from the [Spatie Activity Log package](https://github.com/spatie/laravel-activitylog) within the Laravel Pulse Dashboard. 

Currently, there are two cards: Model Events and Non Model Events.

<img width="1273" alt="image" src="https://github.com/ejntaylor/activitylog-pulse/assets/2080025/a380f14e-0d70-44b5-8d03-c921c98af141">


## Installation

You can install the package via composer:

```bash
composer require ejntaylor/activitylog-pulse
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="activitylog-pulse-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="activitylog-pulse-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="activitylog-pulse-views"
```


## Usage

Add the following to your Pulse Dashboard: resources/views/vendor/pulse/dashboard.blade.php

```php
    <livewire:pulse.activity-log-card cols="6" />

    <livewire:pulse.activity-log-model-events-card cols="6" />
```

Card Type: you can pass a parameter 'type=chart' or  'type=list' to choose the output of the card. Default is 'chart'.

```php
    <livewire:pulse.activity-log-card cols="6" type="chart" />

    <livewire:pulse.activity-log-model-events-card cols="6" type="list" />
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Elliot Taylor](https://github.com/ejntaylor)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
