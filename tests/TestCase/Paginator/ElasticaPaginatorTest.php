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
use Elastica\Type\Mapping;
use Phauthentic\Pagination\PaginationParams;
use Phauthentic\Pagination\Paginator\ElasticaPaginator;
use Phauthentic\Pagination\ParamsFactory\ServerRequestQueryParamsFactory;
use Phauthentic\Pagination\RequestBasedPaginationService;
use PHPUnit\Framework\TestCase;

/**
 * Elastica Paginator Test
 */
class ElasticaPaginatorTest extends TestCase
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
            'name' => 'Eric Evans'
        ]
    ];

    public function elasticSetup()
    {
        if (!class_exists(Client::class)) {
            $this->markSkippedForMissingDependecy(Client::class);
        }

        $this->client = new Client([
            'host' => 'localhost',
            'port' => 9200
        ]);

        $this->index = $this->client->getIndex('pagination-test');
        $this->index->create([], true);
        $this->type = $this->index->getType('pagination-test');

        $mapping = new Mapping();
        $mapping->setType($this->type);
        $mapping->setProperties([
            'name' => [
                'type' => 'keyword'
            ]
        ]);
        $mapping->send();

        foreach ($this->records as $record) {
            $result = $this->type->addDocument(new Document($record['id'], $record));
        }

        sleep(5);
    }

    /**
     * testPaginate
     *
     * @return void
     */
    public function testPaginate(): void
    {
        $this->elasticSetup();

        $query = new Query();
        $params = new PaginationParams();
        $params->setLimit(2);
        $paginator = new ElasticaPaginator($this->type);

        $result = $paginator->paginate($query, $params);

        $this->assertInstanceOf(ResultSet::class, $result);
        $this->assertEquals(2, $result->count());
    }

    /**
     * testPaginateWithSort
     *
     * @return void
     */
    public function testPaginateWithSort(): void
    {
        $this->elasticSetup();

        $query = new Query();
        $params = new PaginationParams();
        $params
            ->setLimit(5)
            ->setSortBy('name');

        $paginator = new ElasticaPaginator($this->type);

        $result = $paginator->paginate($query, $params);

        $results = $result->getResults();
        $names = [];

        foreach ($results as $result) {
            $names[] = $result->getDocument()->get('name');
        }

        $expected = [
            'Bob Martin', 'Eric Evans', 'Florian', 'Phauthentic', 'Robert'
        ];

        $this->assertEquals($expected, $names);
    }
}
