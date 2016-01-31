<?php

namespace pizzaexpress\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use pizzaexpress\Presenters\ProductPresenter;
use pizzaexpress\Models\Product;

/**
 * Class ProductRepositoryEloquent
 * @package namespace pizzaexpress\Repositories;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{

    protected $skipPresenter = true;

    public function lists()
    {
        return $this->model->get(['id', 'name', 'price']);
    }
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
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
        return ProductPresenter::class;
    }


}
