# Framework agnostic Pagination

This library is a framework agnostic way of paginating through data sets. The only dependency is [psr/http-message](https://github.com/php-fig/http-message).

It gets the information from the request object that must comply to [the PSR-7 standard](https://www.php-fig.org/psr/psr-7/) and turns it into an object that is passed to a mapper that will map it to the data layer implementation.
 
**This is work on progress! Don't use it yet!**

## How to use it

```php
// Do this or use your favorite DI container to build the service
$service = new PaginationService(
    new PaginationParamsFactory(),
    new PaginationToCakeOrmMapper()
);

// Get the pagination data transfer object
$paginationParams = $service->getPagingParams($request);

// Calls getPagingParams() internally and passes it to the mapper
$resultSet = $service->paginate(
    $request,
    $myRepositoryObject
);
```

## Copyright & License

Licensed under the [MIT license](LICENSE.txt).

* Copyright (c) [Phauthentic](https://github.com/Phauthentic)
