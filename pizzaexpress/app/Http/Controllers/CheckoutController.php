<?php

namespace pizzaexpress\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use pizzaexpress\Http\Requests;
use pizzaexpress\Http\Requests\Api\CheckoutRequest;
use pizzaexpress\Repositories\OrderRepository;
use pizzaexpress\Repositories\ProductRepository;
use pizzaexpress\Repositories\UserRepository;
use pizzaexpress\Services\OrderService;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $orderRepository;
    private $userRepository;
    private $productRepository;
    private $service;

    public function  __construct(
        OrderRepository     $orderRepository,
        UserRepository      $userRepository,
        ProductRepository   $productRepository,
        OrderService $service)
    {
        $this->orderRepository  = $orderRepository;
        $this->userRepository   = $userRepository;
        $this->productRepository= $productRepository;
        $this->service = $service;
    }

    public function inicio()
    {
        return view('customer.welcome');
    }

    public function index()
    {

        $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
        $orders = $this->orderRepository->scopeQuery(function($query) use($clientId){
            return $query->where('client_id', '=', $clientId);
        })->paginate();

        return view('customer.order.index', compact('orders'));
    }

    public function create()
    {
        $products = $this->productRepository->lists();
        return view('customer.order.create', compact('products'));
    }

    public function store(CheckoutRequest $request)
    {
        $data = $request->all();

        $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
        $data['client_id'] = $clientId;

        $this->service->create($data);

        return redirect()->route('index.ordem');

    }

}
