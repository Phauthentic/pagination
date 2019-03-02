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
use Phauthentic\Pagination\Paginator\Doctrine2Paginator;
use Phauthentic\Pagination\Test\TestCase\PaginationTestCase;

/**
 * Users
 *
 * @Entity
 * @Table(name="users")
 */
class Users
{
    /**
     * @Id
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(length=64)
     */
    private $username;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->username;
    }

    /**
     * @return void
     */
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
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration([__DIR__ . "/src"], $isDevMode);

        $conn = [
            'driver' => 'pdo_sqlite',
            'pdo' => $this->getPDO()
        ];

        $this->entityManager = EntityManager::create($conn, $config);
    }

    /**
     * testPaginate
     *
     * @return void
     */
    public function testPaginate(): void
    {
        $repository = $this->entityManager->getRepository(Users::class);

        $queryBuilder = $repository->createQueryBuilder('u');
        $queryBuilder
            ->select([
                'u'
            ]);

        $adapter = new Doctrine2Paginator();
        $params = (new PaginationParams())
            ->setLimit(2)
            ->setDirection(PaginationParams::DIRECTION_DESC)
            ->setSortBy('u.username');

        $results = $adapter->paginate($queryBuilder, $params);

        $i = 0;
        foreach ($results as $r) {
            $i++;
            $this->assertInstanceOf(Users::class, $r);
        }
        $this->assertEquals(2, $i);
    }
}
