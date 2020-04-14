<?php

declare(strict_types=1);

namespace Domain\Employee\Events;


use Domain\Employee\Employee;

interface EmployeeJoin
{
    public function handle(Employee $employee);
}
