<?php

namespace pizzaexpress\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CupomRepository
 * @package namespace pizzaexpress\Repositories;
 */
interface CupomRepository extends RepositoryInterface
{
    public function findByCode($code);
}
