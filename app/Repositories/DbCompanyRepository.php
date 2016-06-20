<?php
/**
 * Created by PhpStorm.
 * User: Nikhil
 * Date: 18-06-2016
 * Time: 11:54 PM
 */

namespace App\Repositories;


use App\Contracts\Repositories\CompanyRepositoryInterface;
use DB;

class DbCompanyRepository extends AbstractDbRepository implements CompanyRepositoryInterface
{

    public function fetchUserCompanies($token, $company_status = 1)
    {
        return DB::table('add_company as ac')
            ->join('cust as c', 'ac.custid', '=', 'c.id')
            ->join('sp_tokens as st', function ($join) use($token, $company_status) {
                return $join->on('st.user_id', '=', 'c.id')
                            ->where('st.token', '=', $token)
                            ->where('ac.status', '=', $company_status);
            })
            ->select([
                'ac.compid as company_id',
                'ac.compname as company_name',
                'ac.address1 as address_line_1',
                'ac.address2 as address_line2',
                'ac.comment as company_description',
                'ac.phone as phone',
                'ac.CRno as company_reg_no',
                'ac.CRdate as company_reg_date',
                'ac.CRexdate as company_reg_ecp_date',
            ]);
    }

}