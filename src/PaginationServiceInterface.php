<?php
declare(strict_types = 1);

namespace Phauthentic\Pagination;

use App\Presentation\Renderer\RendererInterface;
use App\Presentation\View\ViewInterface;

/**
 * Pagination Service Interface
 */
interface PaginationServiceInterface
{
    public function paginate($object);

    public function getPaginationFromRequest();
}
