<?php

declare(strict_types=1);

require_once __DIR__ . "/../vendor/autoload.php";

use App\Http\Server;
use DI\ContainerBuilder;
use Doctrine\Common\Annotations\AnnotationRegistry;

AnnotationRegistry::registerLoader('class_exists');

$containerBuilder = new ContainerBuilder();

$config = require_once __DIR__ . '/../config/services.php';

$containerBuilder->useAutowiring(true);
$containerBuilder->useAnnotations(true);
$containerBuilder->addDefinitions($config);

/** @noinspection PhpUnhandledExceptionInspection */
$container = $containerBuilder->build();

$routes = require_once __DIR__ . '/../config/routes.php';

$server = new Server(8000, '127.0.0.1');

$server->useRouters($routes);
$server->useContainer($container);

$server->run();
