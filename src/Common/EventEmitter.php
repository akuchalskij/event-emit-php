<?php

declare(strict_types=1);

namespace EventEmitter\Common;

use DI\Annotation\Inject;
use DI\Annotation\Injectable;

/**
 * @Injectable()
 * Class EventEmitter
 * @package EventEmitter\Common
 */
final class EventEmitter
{
    /**
     * @Inject()
     * @var EventManager
     */
    private EventManager $manager;

    public function __construct(EventManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param string $eventName
     * @param array $args
     * @throws \Exception
     */
    public function emit(string $eventName, array $args)
    {
        $handlers = $this->manager->create($eventName);

        foreach ($handlers as $handler)
        {
            $handler->handle(...$args);
        }
    }
}
