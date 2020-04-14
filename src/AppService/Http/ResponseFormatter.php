<?php

declare(strict_types=1);

namespace AppService\Http;

final class ResponseFormatter
{
    public static function one($resource): array
    {
        return array_filter([
            'data' => $resource,
        ]);
    }

    public static function collection(Collection $collection): array
    {
        return array_filter([
            'meta' => [
                'size' => $collection->limit,
                'page' => $collection->page,
                'total' => $collection->total,
            ],
            'data' => $collection->data,
        ]);
    }
}
