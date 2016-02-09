<?php
/**
 * Created by PhpStorm.
 * User: ClaudioSouza
 * Date: 18/01/2016
 * Time: 15:33
 */

namespace pizzaexpress\Http\Controllers;


use pizzaexpress\Http\Requests\AdminOrderRequest;
use pizzaexpress\Repositories\OrderRepository;
use pizzaexpress\Repositories\UserRepository;
use pizzaexpress\Repositories\UserRepositoryEloquent;

class OrdersController extends Controller
{
    private $repository;

    public function  __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $orders = $this->repository->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function edit($id, UserRepositoryEloquent $userRepository)
    {
        $list_status = [0=>'Pendente', 1=>'Despachado', 2=>'Entregue', 3=>'Cancelado'];
        $order = $this->repository->find($id);
        $deliveryman = $userRepository->getDeliverymen();
        return view('admin.orders.edit', compact('order', 'list_status', 'deliveryman'));
    }

    public function update(AdminOrderRequest $request, $id)
    {
        $all = $request->all();
        $this->repository->update($all, $id);

        $orders = $this->repository->paginate(10);
        return view ('admin.orders.index', compact('orders')); //redirect()->route('index.ordem');
    }
}