<?php
/**
 * Created by PhpStorm.
 * User: Nikhil
 * Date: 19-06-2016
 * Time: 09:30 PM
 */

namespace App\Services;


use App\Contracts\Repositories\EmployeeRepositoryInterface;
use App\Contracts\Services\EmployeeServiceInterface;

class EmployeeService extends AbstractBaseService implements EmployeeServiceInterface
{

    /**
     * @var EmployeeRepositoryInterface
    */
    protected $employee_repository;

    public function __construct(EmployeeRepositoryInterface $employee_repository)
    {
        $this->employee_repository = $employee_repository;
    }

    public function getUserEmployees($token, $employee_status = 1)
    {
        return $this->employee_repository->getFetchUserEmployees($token, $employee_status);
    }
}