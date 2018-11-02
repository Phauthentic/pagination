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

use Phauthentic\Pagination\Paginator\ArrayPaginator;
use PHPUnit\Framework\TestCase;

/**
 * Array Paginator Adapter
 */
class ArrayPaginatorTest extends TestCase
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
        $data = [
            'one',
            'two',
            'three',
            'four',
            'five',
            'six',
            'seven',
            'eight',
            'nine',
            'ten'
        ];
        $adapter = new ArrayPaginatorAdapter();
        $params = new PaginationParams();
        $params->setLimit(2)->setPage(3);

        $result = $adapter->paginate($params, $data);
        $this->assertEquals([4 => 'five', 5 => 'six'], $result);

        $params->setLimit(3)->setPage(4);

        $result = $adapter->paginate($params, $data);
        $this->assertEquals([9 => 'ten'], $result);
    }
}
