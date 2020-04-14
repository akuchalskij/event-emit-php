<?php

declare(strict_types=1);

namespace UI\Http\Rest\Controller;

use Application\Commands\EmployeeDismissCommand;
use Application\Commands\EmployeeDismissHandler;
use AppService\Http\JsonResponse;
use Infrastructure\Repository\InMemoryEmployeeRepository;
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
