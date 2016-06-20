<?php
/**
 * Created by PhpStorm.
 * User: Nikhil
 * Date: 19-06-2016
 * Time: 09:29 PM
 */

namespace App\Repositories;


use App\Contracts\Repositories\EmployeeRepositoryInterface;
use DB;

class DbEmployeesRepository extends AbstractDbRepository implements EmployeeRepositoryInterface
{


    public function fetchUserEmployees($token, $employee_status = 1)
    {
        return DB::table('emp as e')
            ->join('cust as c', 'e.custid', '=', 'c.id')
            ->join('sp_tokens as st', function ($join) use($token, $employee_status) {
                return $join->on('st.user_id', '=', 'c.id')
                            ->where('st.token', '=', $token)
                            ->where('e.status', '=', $employee_status);
            })
            ->select([
                'e.empid as emp_id',
                DB::raw("CONCAT(e.firstname, ' ',e.lastname) as emp_name"),
                'e.gender as gender',
                'e.dob as date_of_birth',
                'e.designation as emp_designation',
                'e.issueddate as issue_date',
                'e.empidexp as emp_exp_date',
                'e.email as emp_email',
                'e.extra as extra',
                'e.image as image_file_name',
                'e.address as address',
                'e.city as city',
                'e.states as state',
                'e.country as country',
                'e.zip as zip',
                'e.visaid as visa_id',
                'e.visaissued as visa_issue_date',
                'e.visaexpiry as visa_exp_date',
                'e.file2 as file_2_name',
                'e.company as emp_company',
                'e.salary as emp_salary',
            ]);
    }
}