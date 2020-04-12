<?php

use App\Controller\EmployeeController;
use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std;
use FastRoute\DataGenerator\GroupCountBased;

$router = new RouteCollector(new Std(), new GroupCountBased());

$router->get('/', EmployeeController::class);
$router->get('/employee', EmployeeController::class);

return $router;
