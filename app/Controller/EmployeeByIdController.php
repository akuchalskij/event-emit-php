<?php

declare(strict_types=1);

namespace App\Controller;

use App\Http\JsonResponse;
use App\Repository\InMemoryEmployeeRepository;
use Psr\Http\Message\ServerRequestInterface;

final class EmployeeByIdController
{
    public function __invoke(ServerRequestInterface $request, string $id): JsonResponse
    {
        $repository = new InMemoryEmployeeRepository();

        $employee = $repository->findEmployeeById((int)$id);

        return JsonResponse::ok(
            [
                "name" => $employee->name,
                "role" => $employee->role,
                "salary" => $employee->salary
            ],
            );
    }
}
