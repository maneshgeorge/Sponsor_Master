<?php
/**
 * Created by PhpStorm.
 * User: Nikhil
 * Date: 11-06-2016
 * Time: 05:30 PM
 */

namespace App\Repositories;

use App\Contracts\Repositories\LoginRepositoryInterface;
use DB;

class DbLoginRepository extends AbstractDbRepository implements LoginRepositoryInterface
{

    public function checkUser($username, $password)
    {
        return DB::table('cust as c')
                ->join('sp_tokens as st', 'c.id', '=', 'st.user_id')
                ->where('c.username', $username)
                ->where('st.password', $password);

    }

    public function fetchNonTokenizeUsers()
    {
        return DB::table('cust as c')
                    ->leftJoin('sp_tokens as st', 'c.id', '=', 'st.user_id')
                    ->whereNull('st.user_id')
                    ->select([
                       'c.id as user_id',
                       'c.username',
                       'c.password',
                    ]);
    }

    public function insertIntoSpTokens($insert_array)
    {
        return DB::table('sp_tokens')
                    ->insert($insert_array);
    }

    public function updateUserToken($user_id, $token)
    {
        return DB::table('sp_tokens')
                    ->where('user_id', $user_id)
                    ->update([
                        'token' => $token
                    ]);
    }
    
}