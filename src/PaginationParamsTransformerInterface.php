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
 * Pagination Params Transformer Interface
 *
 * Use this interface for objects that allow you to convert the pagination
 * params data transfer object into something your app / library is expecting
 * and vice versa.
 */
interface PaginationParamsTransformerInterface
{
    /**
     * Transforms the native implementation in to a pagination params object
     *
     * @param mixed $data Any kind of native pagination data
     * @return \Phauthentic\Pagination\PaginationParamsInterface
     */
    public function toPaginationParams($data): PaginationParamsInterface;

    /**
     * Transforms the pagination params into the native implementation
     *
     * @param \Phauthentic\Pagination\PaginationParamsInterface $paginationParams Pagination Params
     * @return mixed
     */
    public function fromPaginationParams(PaginationParamsInterface $paginationParams);
}
