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

use Phauthentic\Pagination\PaginationParams;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Pagination Service Interface
 */
abstract class AbstractFactory implements PaginationParamsFactoryInterface
{
    /**
     * Pagination class to instantiate by the factory
     *
     * @var string
     */
    public static $paginationParamsClass = PaginationParams::class;
}
