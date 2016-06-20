<?php
/**
 * Created by PhpStorm.
 * User: Nikhil
 * Date: 19-06-2016
 * Time: 08:53 PM
 */

namespace App\Services;


use App\Contracts\Repositories\PartnersRepositoryInterface;
use App\Contracts\Services\PartnersServiceInterface;

class PartnersService extends AbstractBaseService implements PartnersServiceInterface
{

    /**
     * @var PartnersRepositoryInterface
    */
    protected $partner_repository;

    public function __construct(PartnersRepositoryInterface $partner_repository)
    {
        $this->partner_repository = $partner_repository;
    }

    public function getUserPartners($token, $partner_status = 1)
    {
        return $this->partner_repository->getFetchUserPartners($token, $partner_status);
    }
}