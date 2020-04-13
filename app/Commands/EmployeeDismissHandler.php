<?php

declare(strict_types=1);

namespace App\Commands;


use App\Entity\Employee;
use App\Events\EmployeeDismiss;
use App\Repository\InMemoryEmployeeRepository;
use EventEmitter\Common\EventEmitter;

class EmployeeDismissHandler
{
    private EmployeeDismissCommand $command;

    private InMemoryEmployeeRepository $repository;

    public function __construct(EmployeeDismissCommand $command, InMemoryEmployeeRepository $repository)
    {
        $this->command = $command;
        $this->repository = $repository;
    }

    /**
     * @param EventEmitter $emitter
     * @return Employee
     * @throws \Exception
     */
    public function __invoke(EventEmitter $emitter): Employee
    {
       $employee = $this->repository->findEmployeeById($this->command->id());

       $emitter->emit(EmployeeDismiss::class, [$employee]);

       return $employee;
    }
}
