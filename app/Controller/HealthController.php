<?php

declare(strict_types=1);

namespace App\Controller;


use App\Http\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

final class HealthController
{
    public function __invoke(ServerRequestInterface $request): JsonResponse
    {
        return JsonResponse::ok(["status" => "ok"]);
    }
}
