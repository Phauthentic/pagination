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

use Elastica\Client;
use Elastica\Document;
use Elastica\Query;
use Elastica\ResultSet;
use Phauthentic\Pagination\PaginationParams;
use Phauthentic\Pagination\Paginator\ElasticaPaginator;
use Phauthentic\Pagination\ParamsFactory\ServerRequestQueryParamsFactory;
use Phauthentic\Pagination\RequestBasedPaginationService;
use PHPUnit\Framework\TestCase;

/**
 * Doctrine 2 Adapter
 */
class Doctrine2PaginatorTest extends TestCase
{
    protected $records = [
        [
            'id' => 1,
            'name' => 'Florian'
        ],
        [
            'id' => 2,
            'name' => 'Robert'
        ],
        [
            'id' => 3,
            'name' => 'Phauthentic'
        ],
        [
            'id' => 4,
            'name' => 'Bob Martin'
        ],
        [
            'id' => 5,
            'name' => 'Evan Erics'
        ]
    ];

    /**
     * testPaginate
     *
     * @return void
     */
    public function testPaginate(): void
    {
        if (!class_exists(Client::class)) {
            $this->markSkippedForMissingDependecy(Client::class);
        }

        $client = new Client([
            'host' => 'localhost',
            'port' => 9200
        ]);

        $index = $client->getIndex('pagination-test');
        $index->create([], true);
        $type = $index->getType('pagination-test');

        foreach ($this->records as $record) {
            $result = $type->addDocument(new Document($record['id'], $record));
        }

        $query = new Query();
        $params = new PaginationParams();
        $params->setLimit(2);
        $paginator = new ElasticaPaginator($type);

        $result = $paginator->paginate($query, $params);

        $this->assertInstanceOf(ResultSet::class, $result);
        $this->assertEquals(2, $result->getTotalHits());
    }
}
