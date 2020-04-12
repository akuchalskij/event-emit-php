<?php


namespace EventEmitter\Common\Exceptions;


class HandlerDoesNotExistsException extends \Exception
{
    protected $message = "Handler does not exist";
}
