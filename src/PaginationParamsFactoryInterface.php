<?php
declare(strict_types = 1);

namespace Phauthentic\Pagination;

use App\Presentation\Renderer\RendererInterface;
use App\Presentation\View\ViewInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Pagination Service Interface
 */
interface PaginationParamsFactoryInterface
{
    /**
     *
     */
    public function build(ServerRequestInterface $request): PaginationParamsInterface;
}
