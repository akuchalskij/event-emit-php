<?php

declare(strict_types=1);

namespace App\Handlers;


use App\Entity\Employee;
use App\Events\EmployeeDismiss;
use App\Events\EmployeeJoin;
use EventEmitter\Annotations\EventHandler;

/**
 * @EventHandler(name="EmployeeDismiss")
 */
final class OnEmployeeDismissSalaryEventHandler implements EmployeeDismiss
{
    public function handle(Employee $employee)
    {
        $employee->salary = "0";
    }
}
