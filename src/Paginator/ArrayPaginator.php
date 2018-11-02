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

namespace Phauthentic\Pagination\Paginator;

use Phauthentic\Pagination\PaginationParams;
use Phauthentic\Pagination\PaginationParamsInterface;

/**
 * Paginates arrays
 */
class ArrayPaginator implements PaginatorInterface
{
    /**
     * Sort Handler callback
     *
     * @var callable
     */
     protected $sortHandler;

    /**
     * Maps the params to the repository
     *
     * @param \Phauthentic\Pagination\PaginationParamsInterface $paginationParams Pagination params
     * @param array $array
     * @return array
     */
    public function paginate($array, PaginationParamsInterface $paginationParams)
    {
        $paginationParams->setCount(count($array));

        $count = 1;
        $data = [];
        $offset = $paginationParams->getOffset();
        $stopAt = $offset + $paginationParams->getLimit();

        $array = $this->sort($array, $paginationParams);

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

    /**
     * Sorts the array by a callback
     *
     * @param array $array Array
     * @param \Phauthentic\Pagination\PaginationParamsInterface $paginationParams Pagination params
     * @return array
     */
    protected function sort($array, PaginationParams $paginationParams)
    {
        if (empty($this->setSortHandler())) {
            return $array;
        }

        $handler = $this->sortHandler;

        return $handler($array, $paginationParams);
    }

    /**
     * Sets the sort handler callback
     *
     * @return $this
     */
    public function setSortHandler(callable $handler): self
    {
        $this->sortHandler = $handler;

        return $this;
    }
}
