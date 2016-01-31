<?php

namespace pizzaexpress\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface OrderRepository
 * @package namespace pizzaexpress\Repositories;
 */
interface OrderRepository extends RepositoryInterface
{
    public function getByIdDeliveryman($idOrder, $idDeliveryman );
}
