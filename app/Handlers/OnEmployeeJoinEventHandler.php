<?php

declare(strict_types=1);

namespace App\Handlers;


use App\Entity\Employee;
use App\Events\EmployeeJoin;
use EventEmitter\Annotations\EventHandler;

/**
 * @EventHandler(name="EmployeeJoin")
 */
final class OnEmployeeJoinEventHandler implements EmployeeJoin
{
    public function handle(Employee $employee)
    {
        $employee->role = "Joined";
        $employee->salary = "$120'000";
    }
}
