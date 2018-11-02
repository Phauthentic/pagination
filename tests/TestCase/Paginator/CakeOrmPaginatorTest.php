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

use Cake\ORM\TableRegistry;
use Phauthentic\Pagination\Paginator\CakeOrmPaginator;
use Phauthentic\Pagination\PaginationParams;
use Phauthentic\Pagination\ServerRequestQueryParamsFactory;
use Phauthentic\Pagination\RequestBasedPaginationService;
use PHPUnit\Framework\TestCase;

/**
 * Cake Orm Adapter
 */
class CakeOrmPaginatorTest extends TestCase
{
    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        parent::setUp();
    }

    /**
     * Test Pagination
     *
     * @return void
     */
    public function testPaginate(): void
    {
        /*
        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $adapter = new CakeOrmAdapter();
        $params = new PaginationParams();

        $result = $adapter->paginate($params, $usersTable);
        */
    }
}
