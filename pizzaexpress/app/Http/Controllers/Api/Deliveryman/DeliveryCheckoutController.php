<?php

namespace pizzaexpress\Http\Controllers\Api\Deliveryman;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use pizzaexpress\Events\GetLocationDeliveryman;
use pizzaexpress\Http\Controllers\Controller;
use pizzaexpress\Http\Requests;
use pizzaexpress\Models\Geo;
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
            return $query->where('user_deliveryman_id', '=', $id, 'and', 'status', '=', '0' );
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
        $idDeliveryman = Authorizer::getResourceOwnerId();
        return $this->service->updateStatus($id, $idDeliveryman, $request->get('status'));

    }

    public function geo(Request $request, Geo $geo, $id)
    {
        $idDeliveryman = Authorizer::getResourceOwnerId();
        $order = $this->orderRepository->getByIdDeliveryman($id, $idDeliveryman);
        $geo->lat = $request->get('lat');
        $geo->long = $request->get('long');
        event(new GetLocationDeliveryman($geo, $order));
        return$geo;
    }

}
