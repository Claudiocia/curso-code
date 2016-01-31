<?php

namespace pizzaexpress\Http\Controllers\Api\Client;

use Illuminate\Http\Request;


use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use pizzaexpress\Http\Controllers\Controller;
use pizzaexpress\Http\Requests;
use pizzaexpress\Http\Requests\Api\CheckoutRequest;
use pizzaexpress\Repositories\OrderRepository;
use pizzaexpress\Repositories\UserRepository;
use pizzaexpress\Services\OrderService;

class ClientCheckoutController extends Controller
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
        $clientId = $this->userRepository->find($id)->client->id;
        $orders = $this->orderRepository
            ->skipPresenter(false)
            ->with($this->with)
            ->scopeQuery(function($query) use($clientId){
            return $query->where('client_id', '=', $clientId);
        })->paginate();
        return $orders;
    }

    public function store(CheckoutRequest $request)
    {
        $data = $request->all();
        $id = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($id)->client->id;
        $data['client_id'] = $clientId;
        $o = $this->service->create($data);

        return $this->orderRepository
            ->skipPresenter(false)
            ->with($this->with)
            ->find($o->id);
    }

    public function show($id)
    {
        return $this->orderRepository
            ->skipPresenter(false)
            ->with($this->with)
            ->find($id);
    }

}
