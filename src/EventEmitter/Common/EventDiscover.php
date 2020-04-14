<?php

declare(strict_types=1);

namespace EventEmitter\Common;

use Doctrine\Common\Annotations\Reader;
use EventEmitter\Annotations\EventHandler;
use ReflectionClass;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

final class EventDiscover
{
    protected array $events = [];

    private string $namespace;

    private string $path;

    private Reader $reader;

    public function __construct(string $namespace, string $directory, string $rootDir, string $psr4Dir, Reader $reader)
    {
        $this->namespace = $namespace;
        $this->reader = $reader;
        $this->path = $rootDir . $psr4Dir . $directory;
    }

    public function getEvents(): array
    {
       return $this->events ? $this->events : $this->discoverEvents();
    }

    private function discoverEvents(): array
    {
        $finder = new Finder();
        $finder->files()->in($this->path);

        /** @var SplFileInfo $file */
        foreach ($finder as $file) {
            $class = $this->namespace . '\\' .  $file->getBasename('.php');
            /** @noinspection PhpUnhandledExceptionInspection */
            $annotation = $this->reader->getClassAnnotation(new ReflectionClass($class),EventHandler::class);

            if (!$annotation) {
                continue;
            }

            $this->events[$annotation->getName()][] = $class;
        }

        return $this->getEvents();
    }
}
