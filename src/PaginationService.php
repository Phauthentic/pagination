<?php
/**
 * FLAPP! - The frameworkless App
 * Copyright (c) Florian Krämer
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Florian Krämer
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
declare(strict_types = 1);

namespace Phauthentic\Pagination;

use Psr\Http\Message\ServerRequestInterface;

/**
 * PaginationService
 */
class PaginationService
{
    /**
     * @var \Phauthentic\Pagination\PaginationParamsFactoryInterface
     */
    protected $paginationParamsFactory;

    /**
     * @var \Phauthentic\Pagination\PaginationToRepositoryMapperInterface
     */
    protected $paginationToRepositoryMapper;

    /**
     * Constructor
     */
    public function __construct(
        PaginationParamsFactory $paginationParamsFactory,
        PaginationToRepositoryMapperInterface $paginationToRepositoryMapper
    ) {
        $this->paginationParamsFactory = $paginationParamsFactory;
    }

    /**
     *
     */
    public function setPaginationToRepositoryMapper(PaginationToRepositoryMapperInterface $mapper)
    {
        $this->paginationToRepositoryMapper = $mapper;
    }

    /**
     *
     */
    public function setPaginationParamsFactory(PaginationParamsFactory $factory)
    {
        $this->paginationParamsFactory = $factory;
    }

    /**
     *
     */
    public function getPaginationParams(
        ServerRequestInterface $serverRequest
    ): PaginationParamsInterface {
        return $this->paginationParamsFactory->build($serverRequest);
    }

    public function setPagingRequestAttribute(
        ServerRequestInterface $serverRequest,
        PaginationParamsInterface $paginationParams,
        string $attributeName = 'paging'
    ): ServerRequestInterface {
        return $serverRequest->setAttribute($attributeName, $paginationParams);
    }

    /**
     *
     */
    public function paginate(ServerRequestInterface $request, $repository, ?callable $callable = null)
    {
        $params = $this->getPaginationParams($request);

        if ($callable) {
            return $callable($repository, $params);
        }

        return $this->paginationToRepositoryMapper->map($params, $repository);
    }
}
