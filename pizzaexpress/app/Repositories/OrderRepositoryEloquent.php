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
        $result = $this->with(['client', 'items', 'cupom'])->findWhere(['id'=> $idOrder, 'user_deliveryman_id' => $idDeliveryman]);
        if($result instanceof Collection) {
            $result = $result->first();
        }else{
            if(isset($result['data']) && count($result['data']) == 1){
                $result = [
                    'data' => $result['data'][0],
                ];
            }else{
                throw new ModelNotFoundException("Ordem não Existe");
            }
        }

        return $result;
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
