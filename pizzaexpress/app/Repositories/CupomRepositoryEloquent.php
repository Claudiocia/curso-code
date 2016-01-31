<?php

namespace pizzaexpress\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use pizzaexpress\Repositories\CupomRepository;
use pizzaexpress\Models\Cupom;

/**
 * Class CupomRepositoryEloquent
 * @package namespace pizzaexpress\Repositories;
 */
class CupomRepositoryEloquent extends BaseRepository implements CupomRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cupom::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
