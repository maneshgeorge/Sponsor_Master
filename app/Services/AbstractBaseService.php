<?php
/**
 * Created by PhpStorm.
 * User: Nikhil
 * Date: 11-06-2016
 * Time: 05:12 PM
 */

namespace App\Services;


class AbstractBaseService
{

    //Something that need to be common for a service
    public function getPasswordMd5($password)
    {
        $token_secret = env('TOKEN_SECRET');
        return md5($token_secret.$password);
    }
    
}