<?php

declare(strict_types=1);

namespace App\Controller;


use App\Http\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Response;

final class HealthController
{
    public function __invoke(ServerRequestInterface $request): Response
    {
        return JsonResponse::ok(["status" => "ok"]);
    }
}
