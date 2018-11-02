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
namespace Phauthentic\Pagination;

use Phauthentic\Pagination\Paginator\PaginatorInterface;
use Phauthentic\Pagination\ParamsFactory\PaginationParamsFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Pagination Service
 *
 * Application layer pagination service that should in theory be able to paginate
 * any data / persistence layer implementation through the mappers.
 */
class PaginationService
{
    /**
     * Pagination Params Factory
     *
     * @var \Phauthentic\Pagination\PaginationParamsFactoryInterface
     */
    protected $paginationParamsFactory;

    /**
     * Pagination to data layer implementation mapper
     *
     * @var \Phauthentic\Pagination\Paginator\PaginatorInterface;
     */
    protected $paginator;

    /**
     * Constructor
     *
     * @param \Phauthentic\Pagination\PaginationParamsFactoryInterface
     */
    public function __construct(
        PaginationParamsFactoryInterface $paginationParamsFactory,
        PaginatorInterface $paginationAdapter
    ) {
        $this->paginationParamsFactory = $paginationParamsFactory;
        $this->paginator = $paginationAdapter;
    }

    /**
     * Sets the object that maps the pagination data to the underlying implementation
     *
     * @return $this
     */
    public function setPaginator(PaginatorInterface $paginator): self
    {
        $this->paginator = $paginator;

        return $this;
    }

    /**
     * Sets the pagination params factory
     *
     * @return $this
     */
    public function setPaginationParamsFactory(PaginationParamsFactoryInterface $factory): self
    {
        $this->paginationParamsFactory = $factory;

        return $this;
    }

    /**
     * Triggers the pagination
     *
     * @param \Psr\Http\Message\ServerRequestInterface
     * @param mixed $repository The repository / array / collection to paginate
     * @param \Phauthentic\Pagination\PaginationParamsInterface $paginationParams Paging Params
     * @return mixed
     */
    public function paginate($repository, PaginationParamsInterface $paginationParams)
    {
        if ($paginationParams === null) {
            $paginationParams = $this->paginationParamsFactory->build($repository);
        }

        return $this->paginator->paginate($repository, $paginationParams);
    }
}
