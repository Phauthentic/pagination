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

use Phauthentic\Pagination\PaginationParams;
use Phauthentic\Pagination\PaginationParamsFactory;
use Phauthentic\Pagination\PaginationService;
use Phauthentic\Pagination\PaginationToCakeOrmMapper;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Pagination Params Test
 */
class PaginationParamsTest extends TestCase
{
    /**
     * testWithoutValues
     *
     * @return void
     */
    public function testWithoutSettingValues(): void
    {
        $params = new PaginationParams();

        $this->assertEquals(1, $params->getPage());
        $this->assertEquals(1, $params->getPageCount());
        $this->assertEquals(0, $params->getCount());
        $this->assertEquals(1, $params->getLastPage());

        $this->assertNull($params->getNextPage());
        $this->assertNull($params->getPreviousPage());

        $this->assertFalse($params->hasNextPage());
        $this->assertFalse($params->hasPreviousPage());

        $expected = [
            'page' => 1,
            'count' => 0,
            'lastPage' => 1,
            'limit' => 20,
            'nextPage' => NULL,
            'previousPage' => NULL,
            'hasNextPage' => false,
            'hasPreviousPage' => false,
        ];

        $this->assertEquals($expected, $params->toArray());
    }

    /**
     * testWithoutValues
     *
     * @return void
     */
    public function testSettingOtherValues(): void
    {
        $params = new PaginationParams();
        $params->setCount(101);

        $this->assertEquals(1, $params->getPage());
        $this->assertEquals(6, $params->getPageCount());
        $this->assertEquals(101, $params->getCount());
        $this->assertEquals(6, $params->getLastPage());

        $this->assertEquals(2, $params->getNextPage());
        $this->assertNull($params->getPreviousPage());

        $this->assertTrue($params->hasNextPage());
        $this->assertFalse($params->hasPreviousPage());

        $params->setPage(5);
        $this->assertEquals(4, $params->getPreviousPage());
        $this->assertEquals(6, $params->getNextPage());
        $this->assertTrue($params->hasNextPage());
        $this->assertTrue($params->hasPreviousPage());

        $params->setPage(6);
        $this->assertEquals(5, $params->getPreviousPage());
        $this->assertNull($params->getNextPage());
        $this->assertFalse($params->hasNextPage());
        $this->assertTrue($params->hasPreviousPage());
    }
}
