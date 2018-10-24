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
    /**
     * Sets the total count of all records matching the parameters
     *
     * @param int $count Count
     * @return $this
     */
    public function setCount(int $count): self;

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
    public function setPage(int $page): self;

    /**
     * Gets the current page number
     *
     * @return int
     */
    public function getPage(): int;

    /**
     * Sets the direction of ordering
     */
    public function setDirection(string $direction): self;

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
     * @return null|int
     */
    public function getNextPage(): ?int;

    /**
     * @return null|int
     */
    public function getPreviousPage(): ?int;

    /**
     * @return bool
     */
    public function hasPreviousPage(): bool;

    /**
     * @return bool
     */
    public function hasNextPage(): bool;
}
