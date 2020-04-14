<?php

declare(strict_types=1);

namespace EventEmitter\Common;

final class EventEmitter
{
    private EventManager $manager;

    public function __construct(EventManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param string $eventName
     * @param array $args
     * @throws Exceptions\HandlerDoesNotExistsException
     */
    public function emit(string $eventName, array $args): void
    {
        $handlers = $this->manager->create($eventName);

        foreach ($handlers as $handler) {
            $handler->handle(...$args);
        }
    }
}
