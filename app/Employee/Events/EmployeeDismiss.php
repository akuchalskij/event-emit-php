<?php

declare(strict_types=1);

namespace App\Employee\Events;

use App\Employee\Entity\Employee;

interface EmployeeDismiss
{
    public function handle(Employee $employee);
}
