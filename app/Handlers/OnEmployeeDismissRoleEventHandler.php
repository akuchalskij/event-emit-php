<?php

declare(strict_types=1);

namespace App\Handlers;


use EventEmitter\Annotations\EventHandler;
use App\Entity\Employee;
use App\Events\EmployeeDismiss;

/**
 * @EventHandler(name="EmployeeDismiss")
 */
final class OnEmployeeDismissRoleEventHandler implements EmployeeDismiss
{
    public function handle(Employee $employee)
    {
        $employee->role = "Dismissed";
    }
}
