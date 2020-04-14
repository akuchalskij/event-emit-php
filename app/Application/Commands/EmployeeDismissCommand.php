<?php

declare(strict_types=1);

namespace Application\Commands;


final class EmployeeDismissCommand
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }
}
