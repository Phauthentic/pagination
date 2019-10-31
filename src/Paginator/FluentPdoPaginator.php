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
namespace Phauthentic\Pagination\Paginator;

use Envms\FluentPDO\Query;
use Envms\FluentPDO\Queries\Common;
use Phauthentic\Pagination\PaginationParamsInterface;
use InvalidArgumentException;

/**
 * FluentPdoPaginator
 *
 * @link https://github.com/envms/fluentpdo
 */
class FluentPdoPaginator implements PaginatorInterface
{
    /**
     * The Doctrine Paginator Class
     *
     * @var string
     */
    public static $paginatorClass = Paginator::class;

    /**
     * Maps the params to the repository
     *
     * @throws \InvalidArgumentException
     * @throws \Envms\FluentPDO\Exception
     * @param \Envms\FluentPDO\Query $repository
     * @param \Phauthentic\Pagination\PaginationParamsInterface $paginationParams Pagination params
     * @return \Envms\FluentPDO\Queries\Select
     */
    public function paginate($repository, PaginationParamsInterface $paginationParams)
    {
        if (!$repository instanceof Common) {
            throw new InvalidArgumentException(sprintf(
                '$repository must be an instance of %s',
                Common::class
            ));
        }

        $countQuery = clone $repository;
        $countQuery->select('COUNT(*) AS __count__', true);
        $paginationParams->setCount((int)$countQuery->fetch()['__count__']);

        /** @var $repository \Envms\FluentPDO\Query */
        $sortBy = $paginationParams->getSortBy();
        if ($sortBy !== null) {
            $repository->orderBy($sortBy . ' ' . $paginationParams->getDirection());
        }

        return $repository
            ->limit($paginationParams->getLimit())
            ->offset($paginationParams->getOffset());
    }
}
