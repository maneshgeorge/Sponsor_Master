<?php
/**
 * Created by PhpStorm.
 * User: Nikhil
 * Date: 11-06-2016
 * Time: 04:49 PM
 */

namespace App\Http\Controllers\Api;

use App\Contracts\Services\Login\LoginServiceInterface;
use Request;

class LoginController extends AbstractApiController
{

    /**
     * @var LoginServiceInterface
    */
    protected $login_service;


    public function __construct(LoginServiceInterface $login_service)
    {
        parent::__construct();
        $this->login_service = $login_service;
    }

    public function login()
    {
        $received_hash = Request::get('hash');
        $username = Request::get('username');
        $password = Request::get('password');

        $ip = \Illuminate\Http\Request::capture()->ip();

        $generated_hash = $this->generateAuthHash([ $username, $password ]);

        $validate_status = $this->validateHash($received_hash, $generated_hash);

        if (is_array($validate_status))
        {
            return $this->error_msg;
        }

        $user_token = $this->login_service->login($username, $password, $ip);

        if (is_bool($user_token))
            return [ 'error' => 'Bad Auth'];


        return [ 'token' => $user_token, 'status' => 751 ];
    }

}