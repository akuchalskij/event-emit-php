<?php
declare(strict_types=1);

namespace EventEmitter\Annotations;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 * @Target("CLASS")
 */
final class EventHandler
{
    /**
     * @Required
     *
     * @var string
     */
    public string $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
