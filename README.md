

# Light SEO package for Laravel.

[![Version](https://img.shields.io/packagist/v/chrisjk123/laravel-seo.svg?include_prereleases&style=flat&label=packagist)](https://packagist.org/packages/chrisjk123/laravel-seo)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat)](LICENSE.md)
![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/chrisjk123/laravel-seo/run-tests.yml?branch=master)

## Installation

You can install the package via composer:

```bash
composer require chrisjk123/laravel-seo
```

You can optionally publish the config file with:

```bash
php artisan vendor:publish --provider="Chriscreates\Seo\Providers\SeoServiceProvider" --tag="seo-config"
```

## Usage

Set the page title, description, and keywords:

```php
seo()->setTitle('Some page title here');
seo()->setDescription('Some page description here');
seo()->setKeywords(['PHP', 'Laravel', 'Framework');
```

Set custom metadata or override existing metadata from the config:

```php
seo()->setSiteName('opengraph', 'Laravel');

seo()->getSiteName('opengraph'); // Laravel
seo()->get('opengraph', 'site_name'); // Laravel
```

Register a callback to group setting custom metadata from a place such as a service provider:

```php
seo()->registerCallback(function(Seo $seo) {
	$seo->setSiteName('opengraph', 'Laravel');
});
```

Alternatively, you can just set default metadata from the config:

```php
<?php

return [
	// ...

		'metadata' => [
			// ...
			
			'meta' => [
				'class' => \Chriscreates\Seo\MetaTagTypes\MetaTag::class,
				'metadata' => [
						// ...
						
						'theme-color' => '#ffffff',
				],
			],
		],
];
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email christopherjk123@gmail.com instead of using the issue tracker.

## Credits

- [Christopher Kelker](https://github.com/chrisjk123)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
