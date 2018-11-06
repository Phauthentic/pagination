# Quick Start

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
