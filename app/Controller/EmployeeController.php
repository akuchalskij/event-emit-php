<?php

declare(strict_types=1);

namespace App\Controller;

use App\Commands\EmployeeDismissCommand;
use App\Commands\EmployeeDismissHandler;
use App\Repository\InMemoryEmployeeRepository;
use App\Http\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Response;

final class EmployeeController
{
    public function __invoke(ServerRequestInterface $request): Response
    {
        $command = new EmployeeDismissCommand((int)$request->getBody()['id']);

        $handler = new EmployeeDismissHandler($command, new InMemoryEmployeeRepository());

        $handler->__invoke();

        return JsonResponse::noContent();
    }
}
