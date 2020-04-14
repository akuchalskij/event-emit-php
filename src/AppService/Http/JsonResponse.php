<?php

declare(strict_types=1);

namespace AppService\Http;

use React\Http\Response;

final class JsonResponse extends Response
{
    public function __construct(int $statusCode, array $data = null)
    {
        $data = $data ? json_encode($data) : null;
        parent::__construct($statusCode, ['Content-type' => 'application/json'], $data);
    }

    public static function ok(array $data): self
    {
        return new self(200, $data);
    }

    public static function internalServerError(string $reason): self
    {
        return new self(500, ['message' => $reason]);
    }

    public static function notFound(): self
    {
        return new self(404);
    }

    public static function noContent(): self
    {
        return new self(204);
    }

    public static function badRequest(string ...$errors): self
    {
        return new self(400, ['errors' => $errors]);
    }

    public static function created(array $data): self
    {
        return new self(201, $data);
    }
}
