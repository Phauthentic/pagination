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
 * Pagination Data Object
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

    /**
     * The limit per page, or records per page
     *
     * @var int
     */
    protected $limit = 20;

    /**
     * @var int
     */
    protected $maxLimit = 200;

    /**
     * @var string|null
     */
    protected $sortBy = null;

    /**
     * @var int
     */
    protected $page = 1;

    /**
     * @var int
     */
    protected $pageCount = 1;

    /**
     * @var int
     */
    protected $count = 0;

    /**
     * @inheritDoc
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @inheritDoc
     */
    protected function calculatePageCount()
    {
        $count = $this->count / $this->limit;

        if ((int)$count === 0) {
            $count = 1;
        } else {
            $count = (int)ceil($count);
        }

        $this->pageCount = $count;
    }

    /**
     * @inheritDoc
     */
    public function setCount(int $count): PaginationParamsInterface
    {
        $this->count = $count;
        $this->calculatePageCount();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setDirection(string $direction): PaginationParamsInterface
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    public function setSortBy(?string $sortBy): PaginationParamsInterface
    {
        $this->sortBy = $sortBy;

        return $this;
    }

    public function getSortBy(): ?string
    {
        return $this->sortBy;
    }

    /**
     * @inheritDoc
     */
    public function setPage(int $page): PaginationParamsInterface
    {
        if ($page === 0) {
            throw new InvalidArgumentException('Page value must be greater than zero');
        }

        $this->page = $page;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setMaxLimit(int $maxLimit): PaginationParamsInterface
    {
        if ($maxLimit < 2) {
            throw new InvalidArgumentException('Max limit value must be greater than one');
        }

        $this->maxLimit = $maxLimit;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLimit(int $limit): PaginationParamsInterface
    {
        if ($limit > $this->maxLimit) {
            throw new InvalidArgumentException(sprintf(
                'Limit must be smaller than %d',
                $this->maxLimit
            ));
        }

        if ($limit < 1) {
            throw new InvalidArgumentException('Limit must be equal or greater than 1');
        }

        $this->limit = $limit;
        $this->calculatePageCount();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @inheritdoc
     */
    public function getOffset(): int
    {
        return ($this->page - 1) * $this->limit;
    }

    /**
     * @inheritDoc
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @inheritDoc
     */
    public function getPageCount(): int
    {
        $this->calculatePageCount();

        return $this->pageCount;
    }

    /**
     * @inheritDoc
     */
    public function getLastPage(): int
    {
        return $this->pageCount;
    }

    /**
     * @inheritDoc
     */
    public function getNextPage(): ?int
    {
        if ($this->page < $this->getPageCount()) {
            return $this->page + 1;
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function getPreviousPage(): ?int
    {
        if ($this->page > 1) {
            return $this->page - 1;
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function hasPreviousPage(): bool
    {
        return $this->getPreviousPage() !== null;
    }

    /**
     * @inheritDoc
     */
    public function hasNextPage(): bool
    {
        return $this->getNextPage() !== null;
    }

    /**
     * Returns the current state of the object as array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'page' => $this->page,
            'count' => $this->count,
            'lastPage' => $this->getLastPage(),
            'limit' => $this->limit,
            'direction' => $this->direction,
            'sortBy' => $this->sortBy,
            'nextPage' => $this->getNextPage(),
            'previousPage' => $this->getPreviousPage(),
            'hasNextPage' => $this->hasNextPage(),
            'hasPreviousPage' => $this->hasPreviousPage()
        ];
    }
}
