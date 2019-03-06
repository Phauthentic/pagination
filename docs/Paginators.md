# Paginators

Paginators are the adapters that will take the request pagination parameter transfer object and use it's data to implement the underlying pagination of whatever framework, ORM or other thing you want to paginate.

A paginator *must* implement the PaginatorInterface. The interface requires a single metod:

```php
public function paginate($repository, PaginationParamsInterface $paginationParams);
```

It takes whatever object is used to handle the pagination in the underlying implementation.

## Array

The array paginator takes arrays and can paginate them:

```php
use Phauthentic\Pagination\PaginationParams;
use Phauthentic\Pagination\Paginator\ArrayPaginator;

$data = [
    [
        'id' => 1,
        'name' => 'Florian'
    ],
    [
        'id' => 2,
        'name' => 'Robert'
    ],
    [
        /* Some more entries... */
    ]
];

$paginator = new ArrayPaginator();
$params = new PaginationParams();

$result = $paginator->paginate($data, $params);
```

You can provide a customized sort callback to the array paginator in the case you want to sort in a specialized way. Alternatively simply extend the ArrayPaginator class.

```php
$paginator = new ArrayPaginator();
$paginator->setSortHandler(function($array, $params) {
    // Your sort logic here
});
```

## Cake ORM

This example assumes CakePHP 3.6 or greater.

```php
use Cake\Database\TableRegistry;
use Phauthentic\Pagination\PaginationParams;
use Phauthentic\Pagination\Paginator\CakeOrmPaginator;

$usersTable = TableRegistry::getTableLocator()->get('Users');

$paginator = new CakeOrmPaginator();
$params = new PaginationParams();


$result = $adapter->paginate($usersTable, $params);
$this->assertCount(2, $result->toArray());

$adapter = new CakeOrmPaginator();
$params = new PaginationParams();

$result = $adapter->paginate($usersTable, $params);
```

## Doctrine 2

```php
use App\ActiveRecord\Users;
use Doctrine\ORM\EntityManager;
use Phauthentic\Pagination\PaginationParams;
use Phauthentic\Pagination\Paginator\Doctrine2Paginator;

// You need to pass your conection and config data
$entityManager = EntityManager::create($conn, $config);

$repository = $entityManager->getRepository(Users::class);

$queryBuilder = $repository->createQueryBuilder('u');
$queryBuilder->select(['u']);

$paginator = new Doctrine2Paginator();
$params = new PaginationParams():

$results = $paginator->paginate($queryBuilder, $params);
```

## Elastica

The paginator was written with [Elastica](https://github.com/ruflin/Elastica) ^6.1 in mind. Here is a complete example including instantiating the ES client object.

```php
use Elastica\Client;
use Elastica\Query;
use Phauthentic\Pagination\PaginationParams;
use Phauthentic\Pagination\Paginator\ElasticaPaginator;

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
