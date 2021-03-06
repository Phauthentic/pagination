<?php
declare(strict_types = 1);
/**
 * Copyright (c) Phauthentic (https://github.com/Phauthentic)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Phauthentic (https://github.com/Phauthentic)
 * @link          https://github.com/Phauthentic
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Phauthentic\Pagination\ParamsFactory;

use Phauthentic\Pagination\PaginationParamsInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Extracts the pagination information from a server requests query string
 */
class ServerRequestQueryParamsFactory extends AbstractFactory
{

    /**
     * Parameter map
     *
     * @var array
     */
    protected $map = [
        'limit' => 'limit',
        'page' => 'page',
        'direction' => 'direction',
        'sortBy' => 'sort'
    ];

    /**
     * Gets the page number value from the server request params
     *
     * @param array $params Server request query params
     * @param string $name of the query param
     * @return int
     */
    public function getPage(array $params, string $name = 'page'): int
    {
        if (isset($params[$name])) {
            return (int)$params[$name];
        }

        return 1;
    }

    /**
     * Gets the limit value from the server request params
     *
     * @param array $params Server request query params
     * @param string $name of the query param
     * @return int
     */
    public function getLimit(array $params, string $name = 'limit'): int
    {
        if (isset($params[$name])) {
            return (int)$params['limit'];
        }

        return 20;
    }

    /**
     * Gets the sort value from the server request params
     *
     * @param array $params Server request query params
     * @param string $name of the query param
     * @return string|null
     */
    public function getSortBy(array $params, string $name = 'sort'): ?string
    {
        if (!empty($params[$name])) {
            return (string)$params[$name];
        }

        return null;
    }

    /**
     * Gets the direction value from the server request params
     *
     * @param array $params Server request query params
     * @param string $name of the query param
     * @return string Must be desc `desc`or `asc`
     */
    public function getDirection(array $params, string $name = 'direction'): string
    {
        if (isset($params[$name])) {
            return (string)$params[$name];
        }

        return 'desc';
    }

    /**
     * Sets the query param mapping
     *
     * @param array $map Query param map
     * @return \Phauthentic\Pagination\PaginationParamsFactoryInterface
     */
    public function setQueryParamMapping(array $map = []): PaginationParamsFactoryInterface
    {
        $this->map = array_merge($this->map, $map);

        return $this;
    }

    protected function mapRequest(ServerRequestInterface $request)
    {
        $queryParams = $request->getQueryParams();

        $params = new static::$paginationParamsClass();

        foreach ($this->map as $setter => $value) {
            $setterMethod = 'set' . $setter;
            $getterMethod = 'get' . $setter;

            if (!is_string($value) && is_callable($value)) {
                $value = $value($request);
            }

            if (isset($queryParams[$value])) {
                $params->{$setterMethod}($this->{$getterMethod}($queryParams, $value));
            }
        }

        return $params;
    }

    /**
     * @inheritDoc
     */
    public function build($data = null): PaginationParamsInterface
    {
        if (!$data instanceof ServerRequestInterface) {
            return new static::$paginationParamsClass();
        }

        return $this->mapRequest($data);
    }
}
