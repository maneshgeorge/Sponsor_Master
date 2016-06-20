<?php
/**
 * Created by PhpStorm.
 * User: Nikhil
 * Date: 11-06-2016
 * Time: 04:50 PM
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class AbstractApiController extends Controller
{

    use LoginTrait;
    
    /**
     * @var int
     */
    protected $user_id;

    /**
     * @var int
     */
    protected $user_timezone;

    /**
     * @var array
     */
    protected $view = [];

    public function __construct()
    {

        if(\Session::has('user_id'))
        {
            $this->user_id = \Session::get('user_id');
        } else {
            $this->user_id = -1;
        }

        if ( \Auth::user() )
        {
            $this->user_id = \Auth::user()->user_id;
            $this->user_timezone = \Auth::user()->user_timezone;
        }


    }

    /**
     * @param $message
     */
    public function putSuccessMessage( $message ){
        \Session::put('success_msg', $message);
    }

    /**
     * Validate request for current resource.
     *
     * @param Request $request
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * @throws \HttpException
     */
    public function validateRequestOrFail($request, array $rules, $messages = [], $customAttributes = [])
    {
        $validator = $this->getValidationFactory()->make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            throw new \HttpException(400, json_encode($validator->errors()->getMessages()));
        }
    }

    public function makeResponse($result, $message)
    {
        return [
            'data'    => $result,
            'message' => $message,
        ];
    }

    public function sendResponse($result, $message)
    {
        return \Response::json($this->makeResponse($result, $message));
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     * e.g. redirectOnResponse('assistTaskCategories.index')
     */
    protected function redirectOnResponse($route,$flash_response = "")
    {
        if (\Request::isXmlHttpRequest()) {

            if($flash_response && $flash_response!="" ){
                return \Response::json($flash_response);

            }

            return $this->sendResponse("redirect", route($route));
        }

        return redirect(route($route));
    }
    
    
    
}