<?php

declare(strict_types=1);

namespace App\Employee\Handlers;


use EventEmitter\Annotations\EventHandler;
use App\Employee\Entity\Employee;
use App\Employee\Events\EmployeeDismiss;

/**
 * @EventHandler(name="EmployeeDismiss")
 */
final class OnEmployeeDismissEventHandler implements EmployeeDismiss
{
    public function handle(Employee $employee)
    {
        $employee->role = "Dismissed";
    }
}
