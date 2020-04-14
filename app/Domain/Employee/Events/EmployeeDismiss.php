<?php

declare(strict_types=1);

namespace Domain\Employee\Events;

use Domain\Employee\Employee;

interface EmployeeDismiss
{
    public function handle(Employee $employee);
}
