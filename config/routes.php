<?php

declare(strict_types=1);

use FastRoute\DataGenerator\GroupCountBased;
use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std;
use UI\Http\Rest\Controller\EmployeeByIdController;
use UI\Http\Rest\Controller\EmployeeController;
use UI\Http\Rest\Controller\EmployeeDismissController;
use UI\Http\Rest\Controller\HealthController;

$router = new RouteCollector(new Std(), new GroupCountBased());

$router->addGroup('/v1', function (RouteCollector $route) {
    /** Get Status Application */
    $route->get('/health', new HealthController());

    /** Work with Employees */
    $route->addGroup('/employee', function (RouteCollector $r) {
        $r->get('/', new EmployeeController());
        $r->get('/{id}/', new EmployeeByIdController());
        $r->get('/{id}/dismiss/', new EmployeeDismissController());
    });
});

return $router;
