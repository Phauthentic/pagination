# Framework agnostic Pagination

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Scrutinizer Coverage](https://img.shields.io/scrutinizer/coverage/g/Phauthentic/pagination/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/Phauthentic/pagination/)
[![Code Quality](https://img.shields.io/scrutinizer/g/Phauthentic/pagination/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/Phauthentic/pagination/)

This library is a framework agnostic way of paginating through data sets. The only dependency is [psr/http-message](https://github.com/php-fig/http-message).

It gets the information from the request object that must comply to [the PSR-7 standard](https://www.php-fig.org/psr/psr-7/) and turns it into an object that is passed to a mapper that will map it to the data layer implementation. You can implement your own paginator based on the [PaginatorInterface](./src/Paginator/PaginatorInterface.php) to create an adapter for your implementation.

## Included Paginator Adapters

 * [Array](http://php.net/manual/en/language.types.array.php)
 * [CakePHP ORM v3](https://book.cakephp.org/3.0/en/orm.html)
 * [Doctrine2](https://www.doctrine-project.org/)
 * [Elastica](https://github.com/ruflin/elastica)
 * [FluentPDO](https://github.com/envms/fluentpdo)

## How to use it

```php
use Phauthentic\Pagination\PaginationService;
use Phauthentic\Pagination\Paginator\ArrayPaginator;

// Do this or use your favorite DI container to build the service
$service = new PaginationService(
    new PaginationParamsFactory(),
    new ArrayPaginator()
);

// Calls getPagingParams() internally and passes it to the mapper
$resultSet = $service->paginate($array);
```

## Copyright & License

Licensed under the [MIT license](LICENSE.txt).

* Copyright (c) [Phauthentic](https://github.com/Phauthentic)
