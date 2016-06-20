<?php
/**
 * Created by PhpStorm.
 * User: Nikhil
 * Date: 18-06-2016
 * Time: 11:51 PM
 */

namespace App\Services;


use App\Contracts\Repositories\CompanyRepositoryInterface;
use App\Contracts\Services\CompanyServiceInterface;

class CompanyService extends AbstractBaseService implements CompanyServiceInterface
{

    /**
     * @var CompanyRepositoryInterface
    */
    protected $company_repository;

    public function __construct(CompanyRepositoryInterface $company_repository)
    {
        $this->company_repository = $company_repository;
    }

    public function getUserCompanies($token, $company_status = 1)
    {
        return $this->company_repository->getFetchUserCompanies($token, $company_status);
    }

}