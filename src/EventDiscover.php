<?php

declare(strict_types=1);

namespace EventEmitter;

use Doctrine\Common\Annotations\Reader;
use EventEmitter\Annotations\EventHandler;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

final class EventDiscover
{
    protected array $events = [];

    private string $namespace;

    private string $directory;

    private Reader $reader;

    private string $rootDir;

    public function __construct($namespace, $directory, $rootDir, Reader $reader)
    {
        $this->namespace = $namespace;
        $this->reader = $reader;
        $this->directory = $directory;
        $this->rootDir = $rootDir;
    }

    public function getEvents(): array
    {
        if (!$this->events) {
            $this->discoverEvents();
        }

        return $this->events;
    }

    private function discoverEvents()
    {
        $path = $this->rootDir . "/app/" . $this->directory . "/";
        $finder = new Finder();
        $finder->files()->in($path);

        /** @var SplFileInfo $file */
        foreach ($finder as $file) {
            $class = $this->namespace . '\\' .  $file->getBasename('.php');

            $annotation = $this->reader->getClassAnnotation(new \ReflectionClass($class),EventHandler::class);

            if (!$annotation) {
                continue;
            }

            $this->events[$annotation->getName()] = $class;
        }
    }
}
