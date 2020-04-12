<?php

namespace EventEmitter\Common;

use EventEmitter\Common\Exceptions\HandlerDoesNotExistsException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class EventManager
 * @package EventEmitter\Common
 */
final class EventManager
{
    private array $handlers = [];

    private EventDiscover $discover;

    private Logger $logger;

    public function __construct(EventDiscover $discover, Logger $logger)
    {
        $this->discover = $discover;
        $this->logger = $logger;

        $this->logger->pushHandler(new StreamHandler(__DIR__ . '/../../var/events.log', Logger::WARNING));
    }

    /**
     * @param string $name
     * @return string
     * @throws HandlerDoesNotExistsException
     */
    public function getEvent(string $name): string
    {
        $events = $this->getEvents();

        if (isset($events[$name])) return $events[$name];

        $this->logger->error("Event $events[$name] does not exist");
        throw new HandlerDoesNotExistsException();
    }

    public function getEvents(): array
    {
        return $this->discover->getEvents();
    }

    /**
     * @param string $name
     * @return array
     * @throws \Exception
     */
    public function create(string $name): array
    {
        foreach ($this->getEvents() as $key => $event) {
            foreach ($event as $class) {
                if ($key === $name) {
                    if (!class_exists($class)) {
                        $this->logger->error("Handler $class for event $name does not exist");
                        throw new HandlerDoesNotExistsException();
                    }

                    $this->logger->info("Handler $class for event $name successfully created");

                    $this->handlers[] = new $class();
                }
            }
        }

        return $this->handlers;
    }
}
