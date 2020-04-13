<?php

declare(strict_types=1);

use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder();

$containerBuilder->useAutowiring(true);
$containerBuilder->useAnnotations(true);
$containerBuilder->addDefinitions(__DIR__ . '/services.php');

/** @noinspection PhpUnhandledExceptionInspection */
return $containerBuilder->build();
