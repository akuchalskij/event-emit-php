<?php

use App\Controller\EmployeeByIdController;
use App\Controller\EmployeeController;
use App\Controller\EmployeeDismissController;
use App\Controller\HealthController;
use FastRoute\DataGenerator\GroupCountBased;
use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std;

$router = new RouteCollector(new Std(), new GroupCountBased());

$router->get('/', new HealthController());
$router->get('/employee/', new EmployeeController());
$router->get('/employee/{id}/', new EmployeeByIdController());
$router->get('/employee/{id}/dismiss/', new EmployeeDismissController());

return $router;
