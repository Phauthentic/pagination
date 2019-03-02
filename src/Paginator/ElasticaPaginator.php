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
use Elastica\Query;
use Elastica\Type;
use InvalidArgumentException;

/**
 * Paginator for the ruflin/elastica library
 */
class ElasticaPaginator implements PaginatorInterface
{
    const ORDER_ADD = 'add';
    const ORDER_REPLACE = 'replace';

    /**
     * Elastica Type
     *
     * @var \Elastica\Type
     */
    protected $type;

    /**
     * Order Mode
     *
     * @var string
     */
    protected $orderMode = self::ORDER_ADD;

    /**
     * Constructor
     *
     * @param \Elastica\Type $type Elastica Type
     */
    public function __construct(Type $type)
    {
        $this->type = $type;
    }

    public function setOrderMode(string $mode): self
    {
        if ($mode !== self::ORDER_ADD || $model !== self::ORDER_REPLACE) {
            throw new InvalidArgumentException();
        }

        $this->orderMode = $mode;

        return $this;
    }

    /**
     * Maps the params to the ES query
     *
     * @param \Phauthentic\Pagination\PaginationParamsInterface $paginationParams Pagination params
     * @param array $array
     * @return array
     */
    public function paginate($query, PaginationParamsInterface $paginationParams)
    {
        if (!$query instanceof Query) {
            throw new InvalidArgumentException();
        }

        $query->setSize($paginationParams->getLimit());
        $query->setFrom($paginationParams->getOffset());

        if ($this->orderMode === self::ORDER_ADD) {
            //$query->setSort($paginationParams->getSortBy());
        } else {
            //$query->addSort($paginationParams->getSortBy());
        }

        $result = $this->type->search($query);

        $paginationParams->setCount($result->getTotalHits());

        return $result;
    }
}
