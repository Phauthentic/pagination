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

use InvalidArgumentException;

/**
 * Pagination Data Transfer Object
 */
class PaginationParams implements PaginationParamsInterface
{
    /**
     * Sort direction
     *
     * This is usually asc or desc in SQL dialects
     *
     * @var string
     */
    protected $direction = 'asc';

    protected $limit = 20;

    protected $maxLimit = 200;

    protected $sort = null;

    protected $page = 1;

    protected $pageCount = 1;

    protected $count = 0;

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): PaginationParamsInterface
    {
        $this->count = $count;

        return $this;
    }

    public function setDirection(string $direction)
    {
        $this->direction = $direction;

        return $this;
    }

    public function setPage(int $page): PaginationParamsInterface
    {
        $this->page = $page;

        return $this;
    }

    public function setMaxLimit(int $maxLimit): PaginationParamsInterface
    {
        $this->maxLimit = $maxLimit;

        return $this;
    }

    public function setLimit(int $limit): PaginationParamsInterface
    {
        if ($limit > $this->maxLimit) {
            throw new InvalidArgumentException(sprintf(
                'Limit must be smaller than %d',
                $this->maxLimit
            ));
        }

        $this->limit = $limit;

        return $this;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getNextPage(): ?int
    {

    }

    public function getPreviousPage(): ?int
    {

    }

    public function hasPreviousPage(): ?bool
    {
        return $this->getPreviousPage() !== null;
    }

    public function hasNextPage(): bool
    {
        return $this->getNextPage() !== null;
    }
}
