<?php

declare(strict_types=1);

use Doctrine\Common\Annotations\AnnotationReader;
use EventEmitter\Common\EventDiscover;
use EventEmitter\Common\EventEmitter;
use EventEmitter\Common\EventManager;

use Monolog\Logger;

use function DI\create;
use function DI\get;

return [
    EventDiscover::class => create(EventDiscover::class)
        ->constructor(
            get('namespaces'),
            get('dir'),
            get('root'),
            get('psr4'),
            new AnnotationReader()
        ),
    Logger::class => create()->constructor(get('dir')),
    EventManager::class => create(EventManager::class)->constructor(get(EventDiscover::class), get(Logger::class)),
    EventEmitter::class => create()->constructor(get(EventManager::class)),
    'namespaces' => "App\\Handlers",
    'dir' => "Handlers",
    'root' => __DIR__ . '/../',
    'psr4' => '/app/'
];
