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
namespace Phauthentic\Pagination\Test\TestCase;

use Phauthentic\Pagination\ServerRequestQueryParamsFactory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Pagination Params Factory Test
 */
class PaginationParamsFactoryTest extends TestCase
{
    /**
     * testBuild
     *
     * @return void
     */
    public function testBuild(): void
    {
        $mockRequest = $this->getMockBuilder(ServerRequestInterface::class)
            ->getMock();

        $mockRequest->expects($this->any())
            ->method('getQueryParams')
            ->willReturn([
                'sort' => 'username',
                'direction' => 'desc'
            ]);

        $factory = new ServerRequestQueryParamsFactory();
        $result = $factory->build($mockRequest);

        //var_export($result->toArray());
    }
}
