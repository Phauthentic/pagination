<?php
declare(strict_types = 1);

namespace Phauthentic\Pagination;

use App\Presentation\Renderer\RendererInterface;
use App\Presentation\View\ViewInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Pagination Service Interface
 */
class PaginationParamsFactory implements PaginationParamsFactoryInterface {

    /**
     * @var array
     */
    protected $map = [
        'limit' => 'limit',
        'page' => 'page',
        'direction' => 'direction'
    ];

    /**
     *
     */
    public function setQueryParamMapping(array $map): self
    {
        $this->map = $map;
    }

    protected function mapRequest($request)
    {
        $queryParams = $request->getQueryParams();
        $params = new PaginationParams();

        foreach ($this->map as $setter => $value) {
            $method = 'set' . $setter;
            if (is_callable($value)) {
                $value = $value($request);
            }
            if (isset($queryParams[$value])) {
                $params->{$method}($queryParams[$value]);
            }
        }

        return $params;
    }

    /**
     * @inheritDoc
     */
    public function build(ServerRequestInterface $request): PaginationParamsInterface
    {
        return $this->mapRequest($request);
    }
}
