<?php

namespace pizzaexpress\Repositories;

use pizzaexpress\Presenters\UserPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use pizzaexpress\Repositories\UserRepository;
use pizzaexpress\Models\User;

/**
 * Class UserRepositoryEloquent
 * @package namespace pizzaexpress\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function getDeliverymen()
    {
       return $this->model->where(['role'=>'deliveryman'])->lists('name', 'id');

    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return UserPresenter::class;
    }
}
