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
 * PaginationToDoctrineRepositoryMapper
 *
 * @link https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/tutorials/pagination.html
 */
class PaginationToDoctrineMapper implements PaginationToRepositoryMapperInterface
{
    /**
     * Maps the params to the repository
     *
     * @param \Phauthentic\Pagination\PaginationParamsInterface $paginationParams Pagination params
     * @param mixed $repository
     */
    public function map(PaginationParams $paginationParams, $repository) {
        $query = $repository
           ->setFirstResult($paginationParams->getCurrentPage())
           ->setMaxResults($paginationParams->getLimit());

        return new Paginator($query, $fetchJoinCollection = true);
    }
}
