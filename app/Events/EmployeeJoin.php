<?php

declare(strict_types=1);

namespace App\Events;

use App\Entity\Employee;

interface EmployeeJoin
{
    public function handle(Employee $employee);
}
