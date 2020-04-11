<?php

namespace EventEmitter\Common;

class EventManager
{
    private EventDiscover $discover;

    public function __construct(EventDiscover $discover)
    {
        $this->discover = $discover;
    }

    public function getEvents(): array
    {
        return $this->discover->getEvents();
    }

    public function getEvent($name) {
        $events = $this->discover->getEvents();
        if (isset($events[$name])) {
            return $events[$name];
        }

        throw new \Exception('Event not found.');
    }


    public function create(string $name) {
        $events = $this->getEvents();
        if (array_key_exists($name, $events)) {
            $class = $events[$name];

            if (!class_exists($class)) {
                throw new \Exception('Event class does not exist.');
            }

            return new $class();
        }

        throw new \Exception('Event does not exist.');
    }

}
