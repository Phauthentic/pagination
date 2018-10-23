<?php
declare(strict_types = 1);

namespace Phauthentic\Pagination\Test\TestCase;

use Phauthentic\Pagination\PaginationParamsFactory;
use Phauthentic\Pagination\PaginationService;
use Phauthentic\Pagination\PaginationToCakeOrmMapper;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

class PaginationServiceTest extends TestCase
{

    public function testService()
    {
        $request = $this->getMockBuilder(ServerRequestInterface::class)
            ->getMock();

        $request->expects($this->any())
            ->method('getQueryParams')
            ->willReturn([
                'direction' => 'asc'
            ]);

        $service = new PaginationService(new PaginationParamsFactory(), new PaginationToCakeOrmMapper());

        $result = $service->getPaginationParams($request);

        var_dump($result);
    }
}
