<?php

namespace pizzaexpress\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use pizzaexpress\Presenters\OrderPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use pizzaexpress\Models\Order;

/**
 * Class OrderRepositoryEloquent
 * @package namespace pizzaexpress\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    protected $skipPresenter = true;

    public function getByIdDeliveryman($idOrder, $idDeliveryman)
    {
        $result = $this->model
            ->where('id', $idOrder)
            ->where('user_deliveryman_id', $idDeliveryman)
            ->first();
       if($result){
           return $this->parserResult($result);
       }
        throw (new ModelNotFoundException())->setModel(get_class($this->model));
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public  function presenter()
    {
        return OrderPresenter::class;
    }
}
