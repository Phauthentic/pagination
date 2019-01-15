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
interface PaginationParamsInterface
{
    const DIRECTION_ASC = 'asc';
    const DIRECTION_DESC = 'desc';

    /**
     * Sets the field to sort by
     *
     * @param string $field
     * @return $this
     */
    public function setSortBy(?string $field): PaginationParamsInterface;

    /**
     * Gets the field to sort by
     *
     * @return string
     */
    public function getSortBy(): ?string;

    /**
     * Sets the limit (records per page)
     *
     * @param int $limit Limit
     * @return self
     */
    public function setLimit(int $limit): PaginationParamsInterface;

    /**
     * Gets the limit
     *
     * @return int
     */
    public function getLimit(): int;

    /**
     * Sets the total count of all records matching the parameters
     *
     * @param int $count Count
     * @return $this
     */
    public function setCount(int $count): PaginationParamsInterface;

    /**
     * Gets the total count of all records
     *
     * @return int
     */
    public function getCount(): int;

    /**
     * Sets the page number
     *
     * @param int $page Page
     * @return self
     */
    public function setPage(int $page): PaginationParamsInterface;

    /**
     * Gets the current page number
     *
     * @return int
     */
    public function getPage(): int;

    /**
     * Gets the page count
     *
     * @return int
     */
    public function getPageCount(): int;

    /**
     * Gets the actual offset value
     *
     * @return int
     */
    public function getOffset(): int;

    /**
     * Sets the direction of ordering
     */
    public function setDirection(string $direction): PaginationParamsInterface;

    /**
     * Gets the direction of ordering
     *
     * @return string
     */
    public function getDirection(): string;

    /**
     * Sets the maximum allowed limit value
     *
     * @param int $maxLimit Max allowed limit value
     * @return $this
     */
    public function setMaxLimit(int $maxLimit): PaginationParamsInterface;

    /**
     * Gets the next page number
     *
     * @return null|int
     */
    public function getNextPage(): ?int;

    /**
     * Gets the previous page number
     *
     * @return null|int
     */
    public function getPreviousPage(): ?int;

    /**
     * Checks if a previous page exists
     *
     * @return bool
     */
    public function hasPreviousPage(): bool;

    /**
     * Checks if the next page exists
     * @return bool
     */
    public function hasNextPage(): bool;
}
