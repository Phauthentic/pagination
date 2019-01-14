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

use Cake\Datasource\QueryInterface;
use InvalidArgumentException;
use Phauthentic\Pagination\PaginationParamsInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Pagination To Cake Orm Mapper
 */
class CakeOrmPaginator implements PaginatorInterface
{
    /**
     * Maps the params to the repository
     *
     * @param \Phauthentic\Pagination\PaginationParamsInterface $paginationParams Pagination params
     * @param mixed $repository
     * @return mixed
     */
    public function paginate($repository, PaginationParamsInterface $paginationParams)
    {
        /** @var \Cake\Database\Query $query */
        $query = null;
        if ($repository instanceof QueryInterface) {
            $query = $repository;
            $object = $query->getRepository();
        } else {
            $query = $repository->find();
        }

        if (!$query instanceof QueryInterface) {
            throw new InvalidArgumentException();
        }

        $count = $query->count();
        $paginationParams->setCount($count);

        $sortBy = $paginationParams->getSortBy();
        if ($sortBy !== null) {
            if (strpos($sortBy, '.') === false) {
                $sortBy = $object->aliasField($sortBy);
            }
            if ($paginationParams->getDirection() === 'desc') {
                $query->orderDesc($sortBy);
            } else {
                $query->orderAsc($sortBy);
            }
        }

        return $query
            ->limit($paginationParams->getLimit())
            ->offSet($paginationParams->getOffSet())
            ->all();
    }
}
