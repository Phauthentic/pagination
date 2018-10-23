<?php
declare(strict_types = 1);

namespace Phauthentic\Pagination;

/**
 * Pagination Data Transfer Object
 */
class PaginationParams implements PaginationParamsInterface
{
    protected $direction = 'asc';

    protected $page = 1;

    protected $limit = 20;

    protected $currentPage = 1;

    protected $totalCount = 0;

    public function setDirection(string $direction)
    {
        $this->direction = $direction;

        return $this;
    }

    public function setPage(int $page)
    {
        $this->page = $page;
    }

    public function setLimit(int $limit)
    {
        $this->limit = $limit;
    }

    public function getLimit(): init
    {
        return $this->limit;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
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
