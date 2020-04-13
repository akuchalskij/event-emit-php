<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Employee;
use App\Http\JsonResponse;
use App\Repository\InMemoryEmployeeRepository;
use Psr\Http\Message\ServerRequestInterface;

final class EmployeeController
{
    public function __invoke(ServerRequestInterface $request): JsonResponse
    {
        $repository = new InMemoryEmployeeRepository();

        $employee = $repository->findAll();

        return JsonResponse::ok(
            array_map(
                fn(Employee $employee) => [
                    "name" => $employee->name,
                    "role" => $employee->role,
                    "salary" => $employee->salary
                ],
                $employee
            )
        );
    }
}
