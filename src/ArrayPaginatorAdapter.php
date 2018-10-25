<?php
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
declare(strict_types = 1);

namespace Phauthentic\Pagination;

/**
 * Paginates arrays
 */
class ArrayPaginatorAdapter implements PaginationAdapterInterface
{
    /**
     * Maps the params to the repository
     *
     * @param \Phauthentic\Pagination\PaginationParamsInterface $paginationParams Pagination params
     * @param mixed $repository
     * @return mixed
     */
    public function paginate(PaginationParamsInterface $paginationParams, $array)
    {
        $paginationParams->setCount(count($array));

        $count = 1;
        $data = [];
        $offset = $paginationParams->getOffset();
        $stopAt = $offset + $paginationParams->getLimit();

        foreach ($array as $key => $value) {
            if ($count > $stopAt) {
                break;
            }

            if ($count > $paginationParams->getOffset()) {
                $data[$key] = $value;
            }

            $count++;
        }

        return $data;
    }
}
