<?php

declare(strict_types=1);

namespace App\Employee\Handlers;


use App\Employee\Entity\Employee;
use App\Employee\Events\EmployeeJoin;
use EventEmitter\Annotations\EventHandler;

/**
 * @EventHandler(name="EmployeeDismiss")
 */
final class OnEmployeeJoinEventHandler implements EmployeeJoin
{
    public function handle(Employee $employee)
    {
        $employee->role = "Joined";
        $employee->salary = "$120'000";
    }
}
