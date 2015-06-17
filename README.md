# Pagination

[![Latest Version on Packagist](https://img.shields.io/packagist/v/masnathan/pagination.svg?style=flat-square)](https://packagist.org/packages/masnathan/pagination)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/MASNathan/Pagination/master.svg?style=flat-square)](https://travis-ci.org/MASNathan/Pagination)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/masnathan/pagination.svg?style=flat-square)](https://scrutinizer-ci.com/g/masnathan/pagination/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/masnathan/pagination.svg?style=flat-square)](https://scrutinizer-ci.com/g/masnathan/pagination)
[![Total Downloads](https://img.shields.io/packagist/dt/masnathan/pagination.svg?style=flat-square)](https://packagist.org/packages/masnathan/pagination)
[![Support via Gittip](https://img.shields.io/gittip/ReiDuKuduro.svg?style=flat-square)](https://gratipay.com/~ReiDuKuduro/)

Lightweight and easy to use pagination library

## Install

Via Composer

``` bash
$ composer require masnathan/pagination
```

## Usage

``` php
use MASNathan\Pagination\Pagination;

$pager = new Pagination($totalPages, $boundaries, $around, $currentPage);

foreach ($pager->getPages() as $pageLabel) {
    echo sprintf('<a href="/list/page/%s">%s</a>', $pageLabel, $pageLabel);
}
```

You can also check the ```MASNathan\Pagination\Html\Pagination``` for a html builder, it's possible to extend it as well, check the [Bootstrap class](src/Html/Bootstrap.php).

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email andre.r.flip@gmail.com instead of using the issue tracker.

## Credits

- [André Filipe](https://github.com/masnathan)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
