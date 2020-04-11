<?php

declare(strict_types=1);

namespace App\Employee\Events;

use App\Employee\Entity\Employee;

interface EmployeeJoin
{
    public function handle(Employee $employee);
}
