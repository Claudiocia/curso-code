<?php

namespace pizzaexpress\Http\Controllers\Api\Client;

use Illuminate\Http\Request;


use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use pizzaexpress\Http\Controllers\Controller;
use pizzaexpress\Repositories\ProductRepository;
use pizzaexpress\Http\Requests;
use pizzaexpress\Http\Requests\Api\CheckoutRequest;
use pizzaexpress\Repositories\OrderRepository;
use pizzaexpress\Repositories\UserRepository;
use pizzaexpress\Services\OrderService;

class ClientProductController extends Controller
{

    private $productRepository;

    public function  __construct(ProductRepository $productRepository)
    {
        $this->productRepository  = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->skipPresenter(false)->all();

        return $products;
    }

}
