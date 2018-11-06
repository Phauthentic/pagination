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
use Phauthentic\Pagination\Paginator\CakeOrmPaginator;
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
                'direction' => 'asc'
            ]);

        $service = new RequestBasedPaginationService(
            new ServerRequestQueryParamsFactory(),
            new CakeOrmPaginator()
        );

        $params = $service->getPagingParamsFromRequest($request);

        //$result = $service->paginate($params, TableRegistry::getTableLocator()->get('users'));

        //var_dump($result);
    }
}