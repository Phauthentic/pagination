<?php
declare(strict_types = 1);

namespace Phauthentic\Pagination;

use App\Presentation\Renderer\RendererInterface;
use App\Presentation\View\ViewInterface;

/**
 * PaginationParamsFactoryInterface
 */
interface PaginationToRepositoryMapperInterface
{
    /**
     * Maps the params to the repository
     *
     * @param \Phauthentic\Pagination\PaginationParamsInterface $paginationParams Pagination params
     * @param mixed $repository
     */
    public function map(PaginationParams $paginationParams, $repository);
}
