<?php
/**
 * Created by PhpStorm.
 * User: Nikhil
 * Date: 11-06-2016
 * Time: 05:17 PM
 */

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class SponsorMasterInterfaceBindingProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        /*************************************************  Login   ***************************************************/
        $this->app->bind('App\Contracts\Services\LoginServiceInterface', 'App\Services\LoginService');
        $this->app->bind('App\Contracts\Repositories\LoginRepositoryInterface', 'App\Repositories\DbLoginRepository');

        /*************************************************  Events   **************************************************/
        $this->app->bind('App\Contracts\Services\EventsServiceInterface', 'App\Services\EventsService');
        $this->app->bind('App\Contracts\Repositories\EventsRepositoryInterface', 'App\Repositories\DbEventsRepository');

        /*************************************************  Company   *************************************************/
        $this->app->bind('App\Contracts\Services\CompanyServiceInterface', 'App\Services\CompanyService');
        $this->app->bind('App\Contracts\Repositories\CompanyRepositoryInterface', 'App\Repositories\DbCompanyRepository');

        /*************************************************  Partners   ************************************************/
        $this->app->bind('App\Contracts\Services\PartnersServiceInterface', 'App\Services\PartnersService');
        $this->app->bind('App\Contracts\Repositories\PartnersRepositoryInterface', 'App\Repositories\DbPartnersRepository');

        /*************************************************  Employees   ***********************************************/
        $this->app->bind('App\Contracts\Services\EmployeeServiceInterface', 'App\Services\EmployeeService');
        $this->app->bind('App\Contracts\Repositories\EmployeeRepositoryInterface', 'App\Repositories\DbEmployeesRepository');

    }
}