<?php
/**
 * Created by PhpStorm.
 * User: Nikhil
 * Date: 18-06-2016
 * Time: 11:11 PM
 */

namespace App\Http\Controllers\Api;


use App\Contracts\Services\CompanyServiceInterface;
use App\Contracts\Services\EmployeeServiceInterface;
use App\Contracts\Services\EventsServiceInterface;
use App\Contracts\Services\PartnersServiceInterface;

class DataController extends AbstractApiController
{

    /**
     * @var EventsServiceInterface
    */
    protected $events_service;

    /**
     * @var CompanyServiceInterface
    */
    protected $company_service;

    /**
     * @var PartnersServiceInterface
    */
    protected $partner_service;

    /**
     * @var EmployeeServiceInterface
    */
    protected $employee_service;

    public function __construct(EventsServiceInterface $events_service, CompanyServiceInterface $company_service, PartnersServiceInterface $partner_service, EmployeeServiceInterface $employee_service)
    {
        parent::__construct();
        $this->events_service = $events_service;
        $this->company_service = $company_service;
        $this->partner_service = $partner_service;
        $this->employee_service = $employee_service;
    }

    public function getEvents()
    {
        $token = \Request::get('token');
        $received_hash = \Request::get('hash');

        $generated_hash = $this->generateAuthHash([ $token ]);
        $validate_status = $this->validateHash($received_hash, $generated_hash);

        if (is_array($validate_status))
        {
            return $this->error_msg;
        }
        
        return $this->events_service->getUserEvents($token);
    }

    public function getCompanies()
    {
        $token = \Request::get('token');
        $received_hash = \Request::get('hash');

        $generated_hash = $this->generateAuthHash([ $token ]);
        $validate_status = $this->validateHash($received_hash, $generated_hash);

        if (is_array($validate_status))
        {
            return $this->error_msg;
        }

        return $this->company_service->getUserCompanies($token);
    }

    public function getPartners()
    {
        $token = \Request::get('token');
        $received_hash = \Request::get('hash');

        $generated_hash = $this->generateAuthHash([ $token ]);
        $validate_status = $this->validateHash($received_hash, $generated_hash);

        if (is_array($validate_status))
        {
            return $this->error_msg;
        }

        return $this->partner_service->getUserPartners($token);
    }

    public function getEmployees()
    {
        $token = \Request::get('token');
        $received_hash = \Request::get('hash');

        $generated_hash = $this->generateAuthHash([ $token ]);
        $validate_status = $this->validateHash($received_hash, $generated_hash);

        if (is_array($validate_status))
        {
            return $this->error_msg;
        }

        return $this->employee_service->getUserEmployees($token);
    }
}