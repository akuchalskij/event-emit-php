<?php
declare(strict_types=1);

namespace Infrastructure\Repository;

use Domain\Employee\Employee;

class InMemoryEmployeeRepository
{
    /**
     * @var Employee[]
     */
    private array $employees;

    /**
     * InMemoryEmployeeRepository constructor.
     *
     * @param array|null $employees
     */
    public function __construct(array $employees = null)
    {
        $this->employees = $employees ?? [
                1 => new Employee("Bill Gates", '$1.700.000', 'Owner'),
                2 => new Employee("Steve Jobs", '$1.300.000', 'Employee'),
                3 => new Employee("Mark Zuckerberg", '$1.500.000', 'Employee'),
                4 => new Employee("Evan Spiegel", '$1.000.000', 'Employee'),
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return array_values($this->employees);
    }

    /**
     * {@inheritdoc}
     */
    public function findEmployeeById(int $id): Employee
    {
        if (!isset($this->employees[$id])) {
            throw new \Exception("Employee not Found");
        }

        return $this->employees[$id];
    }
}
