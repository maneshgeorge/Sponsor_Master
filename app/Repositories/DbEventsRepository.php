<?php
/**
 * Created by PhpStorm.
 * User: Nikhil
 * Date: 18-06-2016
 * Time: 11:23 PM
 */

namespace App\Repositories;

use App\Contracts\Repositories\EventsRepositoryInterface;
use DB;

class DbEventsRepository extends AbstractDbRepository implements EventsRepositoryInterface
{

    public function fetchUserEvents($token, $event_status = 1)
    {
        return DB::table('event as e')
                    ->join('cust as c', 'e.custid', '=', 'c.id')
                    ->join('sp_tokens as st', function ($join) use($token) {
                        return $join->on('st.user_id', '=', 'c.id')
                                    ->where('st.token', '=', $token);
                    })
                    ->select([
                        'e.name as event_target_name',
                        'e.company as event_target_company',
                        'e.email as event_target_email',
                        'e.title as event_title',
                        'e.comment as event_comment',
                        'e.time as event_time',
                        'e.date as event_date',
                    ]);
    }
    
}