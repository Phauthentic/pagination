# Paginators

Paginators are the adapters that will take the request pagination parameter transfer object and use it's data to implement the underlying pagination of whatever framework, ORM or other thing you want to paginate.

A paginator *must* implement the PaginatorInterface. The interface requires a single metod:

```php
public function paginate($repository, PaginationParamsInterface $paginationParams);
```

It takes whatever object is used to handle the pagination in the underlying implementation.

## Elastica

The paginator was written with Elastica ^6.1 in mind. Here is a complete example including instantiating the ES client object.

```php
$client = new Client([
    'host' => 'localhost',
    'port' => 9200
]);

$type = $client
    ->getIndex('pagination-test')
    ->getType('pagination-test');

// Write your ES query! This is just a *simple* example that will fetch all records
$query = new Query();
$params = new PaginationParams();

// You need to pass the type objcect to the ES paginator
$paginator = new ElasticaPaginator($type);

$result = $paginator->paginate($query, $params);
```
