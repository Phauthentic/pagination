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
namespace Phauthentic\Pagination\Test\TestCase\ParamsFactory;

use Phauthentic\Pagination\PaginationParams;
use Phauthentic\Pagination\PaginationParamsInterface;
use Phauthentic\Pagination\ParamsFactory\ServerRequestQueryParamsFactory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

/**
 * ServerRequestQueryParamsFactoryTest
 */
class ServerRequestQueryParamsFactoryTest extends TestCase {

    /**
     * testBuild
     *
     * @return void
     */
    public function testBuild(): void
    {
        $requestMock = $this->getMockBuilder(ServerRequestInterface::class)
            ->getMock();

        $factory = new ServerRequestQueryParamsFactory();
        $result = $factory->build($requestMock);

        $this->assertInstanceOf(PaginationParamsInterface::class, $result);
    }
}