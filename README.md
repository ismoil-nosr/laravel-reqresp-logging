# Laravel ReqResp Logging

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ismoil-nosr/laravel-reqresp-logging.svg?style=flat-square)](https://packagist.org/packages/ismoil-nosr/laravel-reqresp-logging)
[![Total Downloads](https://img.shields.io/packagist/dt/ismoil-nosr/laravel-reqresp-logging.svg?style=flat-square)](https://packagist.org/packages/ismoil-nosr/laravel-reqresp-logging)
![GitHub Actions](https://github.com/ismoil-nosr/laravel-reqresp-logging/actions/workflows/main.yml/badge.svg)

This package allows you to log requests and responses from
- Laravel Routes
- Http Facade
- GuzzleHttp Client
via ready-to-use Middleware classes.
You can also filter the values of specific keys that are might be present in request/response.

## Installation

1. You can install the package via composer:

```bash
composer require ismoil-nosr/laravel-reqresp-logging
```

2. Publish config
```bash
php artisan vendor:publish --tag=reqresp-config
```

3. Set `.env` 
```env

# REQRESP LOGGING
REQRESP_ENABLED=true
REQRESP_QUEUE_ENABLED=true
REQRESP_FILTER_REQUEST_ENABLED=true
REQRESP_FILTER_RESPONSE_ENABLED=true
REQRESP_FILTER_KEYS=password
REQRESP_LOGGER_CHANNEL=daily
REQRESP_QUEUE_NAME=logs
```

## Usage

```php
// Usage description here
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email ismoil.nosr@gmail.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.