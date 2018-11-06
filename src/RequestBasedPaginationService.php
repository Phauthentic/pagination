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
use Psr\Http\Message\ServerRequestInterface;

/**
 * Pagination Service
 *
 * Application layer pagination service that should in theory be able to paginate
 * any data / persistence layer implementation through the mappers.
 */
class RequestBasedPaginationService extends PaginationService
{
    /**
     * Gets the pagination params from the request
     *
     * @param \Psr\Http\Message\ServerRequestInterface $serverRequest Server Request
     * @return \Phauthentic\Pagination\PaginationParamsInterface
     */
    public function getPagingParamsFromRequest(
        ServerRequestInterface $serverRequest
    ): PaginationParamsInterface {
        return $this->paginationParamsFactory->build($serverRequest);
    }

    /**
     * Sets the pagination data to a request attribute
     *
     * @param \Psr\Http\Message\ServerRequestInterface $serverRequest Server Request
     * @param \Phauthentic\Pagination\PaginationParamsInterface $paginationParams Pagination Params
     * @return \Psr\Http\Message\ServerRequestInterface
     */
    public function setPagingRequestAttribute(
        ServerRequestInterface $serverRequest,
        PaginationParamsInterface $paginationParams,
        string $attributeName = 'paging'
    ): ServerRequestInterface {
        return $serverRequest->withAttribute($attributeName, $paginationParams);
    }
}
