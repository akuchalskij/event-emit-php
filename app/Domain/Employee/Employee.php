<?php

declare(strict_types=1);

namespace Domain\Employee;

final class Employee
{
    public string $name;
    public string $salary;
    public string $role;

    public function __construct(string $name, string $salary, string $role)
    {
        $this->name = $name;
        $this->salary = $salary;
        $this->role = $role;
    }

    public function __toString(): string
    {
        return "Name: $this->name, Role: $this->role, Salary: $this->salary";
    }
}
