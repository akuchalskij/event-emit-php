<?php


namespace EventEmitter\Common\Exceptions;


class EventDoesNotExistsException extends \Exception
{
    protected $message = "Event does not exist";
}
