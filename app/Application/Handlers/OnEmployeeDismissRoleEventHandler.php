<?php

declare(strict_types=1);

namespace Application\Handlers;


use Domain\Employee\Employee;
use Domain\Employee\Events\EmployeeDismiss;
use EventEmitter\Annotations\EventHandler;


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
