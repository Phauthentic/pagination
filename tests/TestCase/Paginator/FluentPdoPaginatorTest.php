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
namespace Phauthentic\Pagination\Test\TestCase\Paginator;

use Envms\FluentPDO\Query;
use Phauthentic\Pagination\Paginator\CakeOrmPaginator;
use Phauthentic\Pagination\PaginationParams;
use Phauthentic\Pagination\Paginator\FluentPdoPaginator;
use Phauthentic\Pagination\ParamsFactory\ServerRequestQueryParamsFactory;
use Phauthentic\Pagination\RequestBasedPaginationService;
use Phauthentic\Pagination\Test\Fixture\FixtureInterface;
use Phauthentic\Pagination\Test\Fixture\UsersFixture;
use Phauthentic\Pagination\Test\TestCase\FixturizedTestCase;
use Phauthentic\Pagination\Test\TestCase\PaginationTestCase;

/**
 * FluentPdoPaginatorTest
 */
class FluentPdoPaginatorTest extends PaginationTestCase
{
    /**
     * Setup
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        if (!class_exists(Query::class)) {
            $this->markTestSkipped('FluentPDO vendor lib is not present');
        }
    }

    /**
     * testSimplePaginate
     *
     * @return void
     */
    public function testSimplePaginate(): void
    {
        $fluent = new Query($this->getPDO());
        $query = $fluent->from('users');

        $adapter = new FluentPdoPaginator();
        $params = new PaginationParams();
        $params->setLimit(2);

        $result = $adapter->paginate($query, $params);
        $result = $result->fetchAll();

        $this->assertCount(2, $result);

        $this->assertEquals('florian', $result[0]['username']);
        $this->assertEquals('robert', $result[1]['username']);
    }

    /**
     * Test Pagination
     *
     * @return void
     */
    public function testPaginate(): void
    {
        $adapter = new FluentPdoPaginator();
        $params = new PaginationParams();
        $params
            ->setLimit(3)
            ->setSortBy('users.username')
            ->setDirection(PaginationParams::DIRECTION_DESC);

        $fluent = new Query($this->getPDO());
        $query = $fluent->from('users');
        $result = $adapter->paginate($query, $params);
        $result = $result->fetchAll();

        $this->assertCount(3, $result);

        $this->assertEquals('steven_hawking', $result[0]['username']);
        $this->assertEquals('leung_ting', $result[2]['username']);

        $fluent = new Query($this->getPDO());
        $query = $fluent->from('users');
        $params->setDirection('asc');
        $result = $adapter->paginate($query, $params);
        $result = $result->fetchAll();

        $this->assertEquals('florian', $result[0]['username']);
        $this->assertEquals('robert', $result[2]['username']);
    }
}
