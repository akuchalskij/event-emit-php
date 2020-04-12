<?php

declare(strict_types=1);

require_once __DIR__ . "/../vendor/autoload.php";

use DI\ContainerBuilder;
use Doctrine\Common\Annotations\AnnotationRegistry;


AnnotationRegistry::registerLoader('class_exists');

$containerBuilder = new ContainerBuilder();

$config = require __DIR__ . '/../config/services.php';

$containerBuilder->useAutowiring(true);
$containerBuilder->useAnnotations(true);
$containerBuilder->addDefinitions($config);

$container = $containerBuilder->build();
