<?php

declare(strict_types=1);

use Doctrine\Common\Annotations\AnnotationReader;
use EventEmitter\Common\EventDiscover;
use EventEmitter\Common\EventManager;

use function DI\create;
use function DI\get;

return [
    EventDiscover::class => create(EventDiscover::class)
        ->constructor(
            get('namespaces'), get('dir'), get('root'), new AnnotationReader()
        ),
    EventManager::class => create(EventManager::class)->constructor(get(EventDiscover::class)),
    'namespaces' => "App\\Handlers",
    'dir' => "Handlers",
    'root' => __DIR__ . '/../',
];
