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

use Phauthentic\Pagination\PaginationParamsFactory;
use Phauthentic\Pagination\PaginationService;
use Phauthentic\Pagination\PaginationToCakeOrmMapper;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Pagination Service Test
 */
class PaginationServiceTest extends TestCase
{
    /**
     * Tests the service
     *
     * @return void
     */
    public function testService(): void
    {
        $request = $this->getMockBuilder(ServerRequestInterface::class)
            ->getMock();

        $request->expects($this->any())
            ->method('getQueryParams')
            ->willReturn([
                'sort' => 'username',
                'direction' => 'asc'
            ]);

        $service = new PaginationService(new PaginationParamsFactory(), new PaginationToCakeOrmMapper());

        $result = $service->getPagingParams($request);

        var_dump($result);
    }
}
