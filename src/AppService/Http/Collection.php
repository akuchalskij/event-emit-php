<?php

declare(strict_types=1);

namespace AppService\Http;

use AppService\Exception\NotFoundException;

final class Collection
{
    public int $page;

    public int $limit;

    public int $total;

    public array $data;

    /**
     * @param int $page
     * @param int $limit
     * @param int $total
     * @param array $data
     * @throws NotFoundException
     */
    public function __construct(int $page, int $limit, int $total, array $data)
    {
        $this->exists($page, $limit, $total);
        $this->page = $page;
        $this->limit = $limit;
        $this->total = $total;
        $this->data = $data;
    }

    /**
     * @param int $page
     * @param int $limit
     * @param int $total
     * @throws NotFoundException
     */
    private function exists(int $page, int $limit, int $total): void
    {
        if (($limit * ($page - 1)) >= $total) {
            throw new NotFoundException();
        }
    }
}
