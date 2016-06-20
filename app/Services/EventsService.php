<?php
/**
 * Created by PhpStorm.
 * User: Nikhil
 * Date: 18-06-2016
 * Time: 11:17 PM
 */

namespace App\Services;


use App\Contracts\Repositories\EventsRepositoryInterface;
use App\Contracts\Services\EventsServiceInterface;

class EventsService extends AbstractBaseService implements EventsServiceInterface
{
    /**
     * @var EventsRepositoryInterface
    */
    protected $events_repository;

    public function __construct(EventsRepositoryInterface $events_repository)
    {
        $this->events_repository = $events_repository;
    }

    public function getUserEvents($token, $event_status = 1)
    {
        return $this->events_repository->getFetchUserEvents($token, $event_status);
    }
}