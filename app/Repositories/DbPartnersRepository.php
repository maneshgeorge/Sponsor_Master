<?php
/**
 * Created by PhpStorm.
 * User: Nikhil
 * Date: 19-06-2016
 * Time: 08:52 PM
 */

namespace App\Repositories;


use App\Contracts\Repositories\PartnersRepositoryInterface;
use DB;

class DbPartnersRepository extends AbstractDbRepository implements PartnersRepositoryInterface
{

    public function FetchUserPartners($token, $partner_status = 1)
    {
        return DB::table('partner as p')
                ->join('cust as c', 'p.custid', '=', 'c.id')
                ->join('sp_tokens as st', function ($join) use($token, $partner_status) {
                    return $join->on('st.user_id', '=', 'c.id')
                                ->where('st.token', '=', $token)
                                ->where('p.status', '=', $partner_status);
                })
                ->select([
                    'p.image as image_file_name',
                    'p.parid as partner_id',
                    'p.compname as company_name',
                    'p.parname as partner_name',
                    'p.address1 as address_line_1',
                    'p.address2 as address_line_2',
                    'p.country as country',
                    'p.phone as phone',
                    'p.email as email',
                ]);
    }
    
}