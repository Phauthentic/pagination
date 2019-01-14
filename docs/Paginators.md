# Paginators

Paginators are the adapters that will take the request pagination parameter transfer object and use it's data to implement the underlying pagination of whatever framework, ORM or other thing you want to paginate.

A paginator *must* implement the PaginatorInterface. The interface requires a single metod:

```php
public function paginate($repository, PaginationParamsInterface $paginationParams);
```

It takes whatever object is used to handle the pagination in the underlying implementation.
