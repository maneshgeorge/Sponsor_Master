<?php
/**
 * Created by PhpStorm.
 * User: Nikhil
 * Date: 11-06-2016
 * Time: 05:11 PM
 */

namespace App\Services;

use App\Contracts\Repositories\LoginRepositoryInterface;
use App\Contracts\Services\LoginServiceInterface;

class LoginService extends AbstractBaseService implements LoginServiceInterface
{
    /**
     * @var LoginRepositoryInterface
    */
    protected $login_repository;

    protected $token_secret;

    public function __construct(LoginRepositoryInterface $login_repository)
    {
        $this->login_repository = $login_repository;
        $this->token_secret = env('TOKEN_SECRET');
    }

    public function tokenizeUser($username, $ip)
    {
        $token = md5($this->token_secret.$username.$ip);

        $update_count = $this->login_repository->updateUserToken($username, $token);

        if ($update_count != 1)
            return '';

        return $token;
    }
    
    public function login($username, $password, $ip)
    {
        $password = $this->getPasswordMd5($password);
        $login_data_valid_count = $this->login_repository->getCheckUser($username, $password);
        
        if (count($login_data_valid_count) != 1)
            return false;

        $login_data_valid_count = $login_data_valid_count[0];

        $token = $this->tokenizeUser($login_data_valid_count->user_id, $ip);

        return $token;
    }

    public function generateTokenForExistingUsers()
    {
        $current_non_hashed_users = $this->login_repository->getFetchNonTokenizeUsers();
        $token_secret = env('TOKEN_SECRET');

        $insert_array = [];
        foreach ($current_non_hashed_users as $user_data)
        {
            $insert_array[] = [
                'user_id' => $user_data->user_id,
                'password' => md5($token_secret.md5($token_secret.$user_data->password)),
                'device_hash' => '',
            ];
        }
        
        if (!empty($insert_array))
            $this->login_repository->insertIntoSpTokens($insert_array);

        return count($insert_array);
    }

}