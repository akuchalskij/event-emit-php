<?php

declare(strict_types=1);

namespace App\Commands;


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
     * @throws \Exception
     */
    public function __invoke()
    {
       $employee = $this->repository->findEmployeeById($this->command->id());
       $emitter = new EventEmitter(EmployeeDismiss::class);
       $emitter->emit([$employee]);
    }
}
