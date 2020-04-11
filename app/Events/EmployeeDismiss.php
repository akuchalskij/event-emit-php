<?php

declare(strict_types=1);

namespace App\Events;

use App\Entity\Employee;

interface EmployeeDismiss
{
    public function handle(Employee $employee);
}
