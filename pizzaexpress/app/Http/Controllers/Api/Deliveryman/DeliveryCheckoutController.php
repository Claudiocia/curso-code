<?php

namespace pizzaexpress\Http\Controllers\Api\Deliveryman;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use pizzaexpress\Http\Controllers\Controller;
use pizzaexpress\Http\Requests;
use pizzaexpress\Repositories\OrderRepository;
use pizzaexpress\Repositories\ProductRepository;
use pizzaexpress\Repositories\UserRepository;
use pizzaexpress\Services\OrderService;

class DeliveryCheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $orderRepository;
    private $userRepository;
    private $service;

    private $with = ['client', 'cupom', 'items'];

    public function  __construct(
        OrderRepository     $orderRepository,
        UserRepository      $userRepository,
        OrderService $service)
    {
        $this->orderRepository  = $orderRepository;
        $this->userRepository   = $userRepository;
        $this->service = $service;
    }

    public function index()
    {

        $id = Authorizer::getResourceOwnerId();
        $orders = $this->orderRepository
            ->skipPresenter(false)
            ->with($this->with)
            ->scopeQuery(function($query) use($id){
            return $query->where('user_deliveryman_id', '=', $id);
        })->paginate();

        return $orders;
    }


    public function show($id)
    {
        $idDeliveryman = Authorizer::getResourceOwnerId();
        return $this->orderRepository
            ->skipPresenter(false)
            ->getByIdDeliveryman($id, $idDeliveryman);
    }

    public function updateStatus(Request $request, $id)
    {
        $status = $request->get('status');
        $idDeliveryman = Authorizer::getResourceOwnerId();
        $order = $this->service->updateStatus($id, $idDeliveryman, $status);
        if($order){
            return $this->orderRepository->find($order->id);
        }
        abort(400, "Ordem de Entrega não encontrada");
    }

}
