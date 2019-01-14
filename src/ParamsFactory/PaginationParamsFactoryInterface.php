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
namespace Phauthentic\Pagination\ParamsFactory;

use Phauthentic\Pagination\PaginationParamsInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Pagination Service Interface
 */
interface PaginationParamsFactoryInterface
{
    /**
     * Builds the pagination parameters
     *
     * @param mixed $data Data from which the factory will generate the params
     * @return \Phauthentic\Pagination\PaginationParamsInterface
     */
    public function build($data = null): PaginationParamsInterface;
}
