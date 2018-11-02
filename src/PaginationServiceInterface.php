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

/**
 * Pagination Service Interface
 */
interface PaginationServiceInterface
{
    /**
     * Triggers the pagination
     *
     * @param \Psr\Http\Message\ServerRequestInterface
     * @param mixed $repository The repository / array / collection to paginate
     * @param \Phauthentic\Pagination\PaginationParamsInterface $paginationParams Paging Params
     * @return mixed
     */
    public function paginate($repository, PaginationParamsInterface $paginationParams);
}
