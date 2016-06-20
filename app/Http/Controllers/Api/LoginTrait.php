<?php
/**
 * Created by PhpStorm.
 * User: Nikhil
 * Date: 17-06-2016
 * Time: 11:40 PM
 */

namespace App\Http\Controllers\Api;


use App\Contracts\Repositories\Login\LoginRepositoryInterface;

trait LoginTrait
{
    protected $EMPTY_HASH_VALUE = 100;

    protected $BAD_AUTH_CODE = 101;

    protected $error_msg = [];

    /**
     * @var LoginRepositoryInterface
    */
    protected $login_repository;

    protected $token_secret;

    public function __construct(LoginRepositoryInterface $login_repository)
    {
        $this->token_secret = env('TOKEN_SECRET');
        $this->login_repository = $login_repository;
    }
    
    protected function validateHash($received_hash, $generated_hash)
    {
        $error_message = '';
        $required_field = '';
        $error_code = 0;

        if (empty($received_hash))
        {
            $error_message = 'Empty Hash';
            $required_field = 'hash';
            $error_code = $this->EMPTY_HASH_VALUE;
        }

        if ($received_hash != $generated_hash)
        {
            $error_message = 'Bad Auth Code';
            $required_field = 'hash';
            $error_code = $this->BAD_AUTH_CODE;
        }

        if (!empty($error_code))
        {
            $this->error_msg = [
                'error' => $error_message,
                'required_field' => $required_field,
                'code' => $error_code,
            ];

            return $this->error_msg;
        }
        else
            return 'pass';
    }

    public function generateAuthHash($data_array)
    {
        $hash_input_string = '';
        foreach ($data_array as $data_item)
        {
            $hash_input_string .= $data_item;
        }

        if (!empty($hash_input_string))
            return md5($this->token_secret.$hash_input_string);

        return '';
    }

    


}