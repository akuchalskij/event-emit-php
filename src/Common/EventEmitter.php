<?php

declare(strict_types=1);

namespace EventEmitter\Common;

use DI\Annotation\Inject;

final class EventEmitter
{
    private string $name;

    /**
     * @Inject()
     * @var EventManager
     */
    private EventManager $manager;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param array $args
     * @throws \Exception
     */
    public function emit(array $args)
    {
        $handlers = $this->manager->create($this->name);

        foreach ($handlers as $handler)
        {
            $handler->handle(...$args);
        }
    }
}
