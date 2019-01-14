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
namespace Phauthentic\Pagination\Paginator;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Psr\Http\Message\ServerRequestInterface;
use Phauthentic\Pagination\PaginationParamsInterface;
use InvalidArgumentException;

/**
 * PaginationToDoctrineRepositoryMapper
 *
 * @link https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/tutorials/pagination.html
 */
class Doctrine2Paginator implements PaginatorInterface
{
    /**
     * The Doctrine Paginator Class
     *
     * @var string
     */
    public static $paginatorClass = Paginator::class;

    /**
     * Maps the params to the repository
     *
     * @param mixed $repository
     * @param \Phauthentic\Pagination\PaginationParamsInterface $paginationParams Pagination params
     * @return \Doctrine\ORM\Tools\Pagination\Paginator
     */
    public function paginate($repository, PaginationParamsInterface $paginationParams)
    {
        if (!$repository instanceof QueryBuilder) {
            throw new InvalidArgumentException(sprintf(
                'The $repository argument must be an instance of %s for this adapter',
                QueryBuilder::class
            ));
        }

        /** @var $repository \Doctrine\ORM\QueryBuilder */
        $sortBy = $paginationParams->getSortBy();
        if (!empty($sortBy)) {
            $repository->addOrderBy(
                $paginationParams->getSortBy(),
                $paginationParams->getDirection()
            );
        }

        $repository
            ->setFirstResult($paginationParams->getOffset())
            ->setMaxResults($paginationParams->getLimit());

        $paginator = new self::$paginatorClass($repository, true);
        $paginationParams->setCount($paginator->count());

        return $paginator;
    }
}
