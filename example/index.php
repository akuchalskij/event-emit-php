<?php

declare(strict_types=1);

require_once __DIR__ . "/vendor/autoload.php";

use DI\ContainerBuilder;
use Doctrine\Common\Annotations\AnnotationRegistry;
use App\Employee\Entity\Employee;
use EventEmitter\EventManager;

AnnotationRegistry::registerLoader('class_exists');

$containerBuilder = new ContainerBuilder();

$config = require __DIR__ . '/../config/services.php';

$containerBuilder->useAutowiring(false);
$containerBuilder->useAnnotations(false);
$containerBuilder->addDefinitions($config);

$container = $containerBuilder->build();

$employee = new Employee("John Doe", "$0", "Not joined");

$manager = $container->get(EventManager::class);

$event = $manager->create('EmployeeDismiss');
$event->handle($employee);
