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

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Phauthentic\Pagination\Paginator\CakeOrmPaginator;
use Phauthentic\Pagination\PaginationParams;
use Phauthentic\Pagination\ParamsFactory\ServerRequestQueryParamsFactory;
use Phauthentic\Pagination\RequestBasedPaginationService;
use Phauthentic\Pagination\Test\Fixture\FixtureInterface;
use Phauthentic\Pagination\Test\Fixture\UsersFixture;
use Phauthentic\Pagination\Test\TestCase\FixturizedTestCase;
use Phauthentic\Pagination\Test\TestCase\PaginationTestCase;

/**
 * Cake Orm Adapter
 */
class CakeOrmPaginatorTest extends PaginationTestCase
{
    /**
     * Setup
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        if (!class_exists(ConnectionManager::class)) {
            $this->markTestSkipped('CakePHP OR vendor lib is not present');
        }

        $url = 'sqlite:///:memory:';

        ConnectionManager::setConfig('default', [
            'url' => $url
        ]);
    }

    /**
     * Test Pagination
     *
     * @return void
     */
    public function testPaginate(): void
    {
        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $usersTable->getConnection()->getDriver()->setConnection($this->getPDO());

        $adapter = new CakeOrmPaginator();
        $params = new PaginationParams();
        $params->setLimit(2);

        $result = $adapter->paginate($usersTable, $params);
        $this->assertCount(2, $result->toArray());

        $adapter = new CakeOrmPaginator();
        $params = new PaginationParams();
        $params
            ->setLimit(3)
            ->setSortBy('username')
            ->setDirection('desc');

        $result = $adapter->paginate($usersTable, $params);
        $this->assertCount(3, $result->toArray());

        $this->assertEquals('steven_hawking', $result->toArray()[0]['username']);
        $this->assertEquals('leung_ting', $result->toArray()[2]['username']);

        $params->setDirection('asc');
        $result = $adapter->paginate($usersTable, $params);
        $this->assertEquals('florian', $result->toArray()[0]['username']);
        $this->assertEquals('robert', $result->toArray()[2]['username']);
    }
}
