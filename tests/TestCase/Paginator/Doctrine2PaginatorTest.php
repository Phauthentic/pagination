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

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Phauthentic\Pagination\PaginationParams;
use Phauthentic\Pagination\ParamsFactory\ServerRequestQueryParamsFactory;
use Phauthentic\Pagination\RequestBasedPaginationService;
use Phauthentic\Pagination\Test\TestCase\PaginationTestCase;
use PHPUnit\Framework\TestCase;

class Users
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $username;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->username;
    }

    public function setName($name)
    {
        $this->username = $name;
    }
}

/**
 * Doctrine 2 Adapter
 */
class Doctrine2PaginatorTest extends PaginationTestCase
{
    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->markTestSkipped();

        if (!class_exists(Setup::class)) {
             $this->markTestSkipped('Doctrine2 library was not found');
        }
    }

    /**
     * testPaginate
     *
     * @return void
     */
    public function testPaginate(): void
    {
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);

        $conn = [
            'driver' => 'pdo_sqlite',
            //'path' => __DIR__ . '/db.sqlite',
        ];

        // obtaining the entity manager
        $entityManager = EntityManager::create($conn, $config);
        $query = $entityManager->find('Users', 1);
    }
}
