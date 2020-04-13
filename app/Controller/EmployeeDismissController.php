<?php

declare(strict_types=1);

namespace App\Controller;

use App\Commands\EmployeeDismissCommand;
use App\Commands\EmployeeDismissHandler;
use App\Http\JsonResponse;
use App\Repository\InMemoryEmployeeRepository;
use Psr\Http\Message\ServerRequestInterface;

final class EmployeeDismissController
{
    public function __invoke(ServerRequestInterface $request, string $id): JsonResponse
    {
        $repository = new InMemoryEmployeeRepository();

        $command = new EmployeeDismissCommand((int) $id);

        new EmployeeDismissHandler($command, $repository);

        return JsonResponse::noContent();
    }
}
