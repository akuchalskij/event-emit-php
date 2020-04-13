<?php

declare(strict_types=1);

require_once __DIR__ . "/../vendor/autoload.php";

use App\Http\Server;
use Doctrine\Common\Annotations\AnnotationRegistry;

AnnotationRegistry::registerLoader('class_exists');

$routes = require_once __DIR__ . '/../config/routes.php';
$container = require_once __DIR__ . '/../config/bootstrap.php';

$server = new Server();

$server->useRouters($routes);
$server->useContainer($container);

$server->run();
