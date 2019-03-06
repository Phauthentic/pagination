# The Pagination Service

## Exmaple

```php
use Phauthentic\Pagination\PaginationService;
use Phauthentic\Pagination\Paginator\ArrayPaginator;

// Do this or use your favorite DI container to build the service
$service = new PaginationService(
    new PaginationParamsFactory(),
    new ArrayPaginator()
);

$array = [
	['username' => 'steven_hawking'],
	['username' => 'leung_ting'],
	// And more...
]

// Calls getPagingParams() internally and passes it to the mapper
$resultSet = $service->paginate($array);
```
