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

use Cake\ORM\TableRegistry;
use Phauthentic\Pagination\Paginator\ArrayPaginator;
use Phauthentic\Pagination\ParamsFactory\ServerRequestQueryParamsFactory;
use Phauthentic\Pagination\RequestBasedPaginationService;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Pagination Service Test
 */
class RequestBasedPaginationServiceTest extends TestCase
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
                'direction' => 'desc'
            ]);

        $service = new RequestBasedPaginationService(
            new ServerRequestQueryParamsFactory(),
            new ArrayPaginator()
        );

        $params = $service->getPagingParamsFromRequest($request);
        $result = $service->paginate([['username' => 'foo'], ['username' => 'bar']], $params);

        $this->assertEquals('username', $params->getSortBy());
        $this->assertEquals('desc', $params->getDirection());
    }
}
